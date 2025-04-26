// Execute clarity script based on stored values
let storedValue;
if (acceptMyCookiesData.options['storage_method'] === 'cookies') {
    const cookie = document.cookie.split('; ').find(row => row.startsWith('clarity_tracking'));
    storedValue = cookie ? cookie.split('=')[1] : 'false';
} else {
    storedValue = localStorage.getItem('clarity_tracking') || 'false';
}

if (storedValue === 'false') {
    // do nothing
} else {
    loadClarityScript();
}

// Load Clarity script on-demand
function loadClarityScript() {
    const cl_id = acceptMyCookiesData.options['cl_id'];
    (function (c, l, a, r, i, t, y) {
        c[a] = c[a] || function () { (c[a].q = c[a].q || []).push(arguments) };
        t = l.createElement(r); t.async = 1; t.src = "https://www.clarity.ms/tag/" + i;
        y = l.getElementsByTagName(r)[0]; y.parentNode.insertBefore(t, y);
    })(window, document, "clarity", "script", cl_id);
    window.clarity('consent');
}
