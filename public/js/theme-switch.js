const toggleSwitch = document.querySelector('input[type="checkbox"]#theme-switch__btn');

// data-theme is set server-side, 'light' by default.

function switchTheme(e) {
    if (e.target.checked) {
        setCookie("theme","dark",30);
        document.documentElement.setAttribute('data-theme', 'dark');
    }
    else {
        setCookie("theme","light",30);
        document.documentElement.setAttribute('data-theme', 'light');
    }
}

toggleSwitch.addEventListener('change', switchTheme, false);
