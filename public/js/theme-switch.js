const toggleSwitch = document.querySelector('input[type="checkbox"]#theme-switch');

if(getCookie("theme") === "dark"){
    toggleSwitch.checked = true;
    document.documentElement.setAttribute('data-theme', 'dark');
}

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
