<div class="hero">
    <div class="breadcrumb">
        <p>Dashboard/Authorities</p>
    </div>

    <div class="theme-switch">
        <label for="theme-switch__btn">
            <input id="theme-switch__btn" class="theme-switch__btn" type="checkbox" @if(Cookie::get('theme')==='dark')checked @endif/>
            <i class="fa-solid fa-lg fa-sun remove-on-dark"></i>
            <i class="fa-solid fa-lg fa-moon remove-on-light"></i>
        </label>
    </div>

</div>
