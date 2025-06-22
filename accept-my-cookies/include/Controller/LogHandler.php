<?php

namespace AcceptMyCookies\Controller;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class LogHandler
{
    /**
     * Log directory path.
     *
     * @var string
     */
    private $log_dir;

    /**
     * Current log file path.
     *
     * @var string
     */
    private $log_file;

    /**
     * Constructor.
     */
    public function __construct()
    {
        // Define the log directory
        $upload_dir = wp_upload_dir();
        $this->log_dir = $upload_dir['basedir'] . '/accept-my-cookies/';

        // Ensure the log directory exists
        if (!file_exists($this->log_dir)) {
            wp_mkdir_p($this->log_dir);
        }

        // Set the current log file
        $this->log_file = $this->log_dir . 'consents-' . gmdate('Y-m') . '.log';

        // Archive last month's log file if it exists
        $this->archive_old_logs();
    }

    /**
     * Archive last month's log file.
     */
    private function archive_old_logs()
    {
        $last_month = gmdate('Y-m', strtotime('last month'));
        $old_log_file = $this->log_dir . 'consents-' . $last_month . '.log';

        if (file_exists($old_log_file)) {
            $archive_file = $this->log_dir . 'consents-' . $last_month . '.zip';
            if (!file_exists($archive_file)) {
                $zip = new \ZipArchive();
                if ($zip->open($archive_file, \ZipArchive::CREATE) === true) {
                    $zip->addFile($old_log_file, 'consents-' . $last_month . '.log');
                    $zip->close();
                    wp_delete_file($old_log_file); // Delete the old log file after archiving
                }
            }
        }
    }

    /**
     * Get the visitor's real IP address.
     *
     * @return string
     */
    private function get_visitor_ip()
    {
        $ip = '';

        // Check for shared or proxy IPs
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = sanitize_text_field(wp_unslash($_SERVER['HTTP_CLIENT_IP']));
        } else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            // HTTP_X_FORWARDED_FOR can contain multiple IPs (e.g., client, proxy1, proxy2)
            $ip_list = explode(',', sanitize_text_field(wp_unslash($_SERVER['HTTP_X_FORWARDED_FOR'])));
            $ip = trim($ip_list[0]); // The first IP is the client's IP
        } else if (!empty($_SERVER['HTTP_X_REAL_IP'])) {
            $ip = sanitize_text_field(wp_unslash($_SERVER['HTTP_X_REAL_IP']));
        } else if (!empty($_SERVER['REMOTE_ADDR'])) {
            $ip = sanitize_text_field(wp_unslash($_SERVER['REMOTE_ADDR'])); // Fallback to REMOTE_ADDR
        }

        // Sanitize the IP address
        return filter_var($ip, FILTER_VALIDATE_IP) ? $ip : 'Unknown';
    }

    /**
     * Log consent data.
     *
     * @param array $data Consent data to log.
     */
    public function log_consent(array $data)
    {
        if (empty($data)) {
            return;
        }

        // Get the visitor's real IP address
        $data['ip'] = $this->get_visitor_ip();

        $param = array();
        foreach ($data['parameters'] as $key => $value) {
            $param[] = $key . ': ' . ($value == 'true' ? '1' : '0');
        }
        $param_string = empty($param) ? '' : ('| ' . implode(' | ', $param));

        // Prepare the log entry
        $log_entry = sprintf(
            "[%s] IP: %s | User-Agent: %s | essentials: %s %s\n",
            gmdate('Y-m-d H:i:s'),
            $data['ip'],
            $data['user_agent'],
            $data['consent'] ? '1' : '0',
            $param_string
        );

        // Append the log entry to the current log file
        file_put_contents($this->log_file, $log_entry, FILE_APPEND);
    }

    /**
     * Extract data from consents log file.
     */
    public static function extract_consent_data_json()
    {
        $upload_dir = wp_upload_dir();
        $log_dir = trailingslashit($upload_dir['basedir']) . 'accept-my-cookies/';
        $log_files = glob($log_dir . 'consents-*.log');

        if (empty($log_files)) {
            return array(); // No log files found
        }

        // Pick the latest log file
        usort($log_files, function ($a, $b) {
            return filemtime($b) - filemtime($a);
        });
        $latest_log = $log_files[0];

        if (!file_exists($latest_log) || filesize($latest_log) === 0) {
            return []; // File doesn't exist or is empty
        }

        $data = array();
        $attributes = array(
            'essentials', 
            'analytics_storage', 
            'ad_storage', 
            'ad_user_data', 
            'ad_personalization',
            'clarity_tracking'
        );

        $handle = fopen($latest_log, 'r');
        if ($handle) {
            while (($line = fgets($handle)) !== false) {
                if (!preg_match('/^\[(\d{4}-\d{2}-\d{2}) \d{2}:\d{2}:\d{2}\]/', $line, $date_match)) {
                    continue;
                }
                $day = (int)substr($date_match[1], -2);

                foreach ($attributes as $attr) {
                    if (preg_match('/\b' . preg_quote($attr, '/') . ': ([01])/', $line, $match)) {
                        $val = $match[1];
                        if (!isset($data[$attr])) {
                            $data[$attr] = array('1' => array(), '0' => array());
                        }
                        if (!isset($data[$attr][$val][$day])) {
                            $data[$attr][$val][$day] = 0;
                        }
                        $data[$attr][$val][$day]++;
                    }
                }
            }
            fclose($handle);
        }

        return $data;
    }
}