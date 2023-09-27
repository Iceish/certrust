<script setup>
import Cookies from "@/assets/js/cookies";
import TheBreadcrumb from "@/components/TheBreadcrumb.vue";
  const themeSwitch = (e) => {
    if (e.target.checked){
      Cookies.set("theme", "dark")
      document.documentElement.setAttribute("data-theme", "dark");
    }
    else{
      Cookies.set("theme", "light")
      document.documentElement.setAttribute("data-theme", "light");
    }
  };
</script>

<template>
  <div class="hero">
    <TheBreadcrumb/>

    <div class="theme-switch">
      <label for="theme-switch__btn">
        <input @change="themeSwitch($event)" id="theme-switch__btn" class="theme-switch__btn" type="checkbox" :checked="Cookies.get('theme') === 'dark'"/>
        <i class="fa-solid fa-lg fa-sun remove-on-dark"></i>
        <i class="fa-solid fa-lg fa-moon remove-on-light"></i>
      </label>
    </div>

  </div>
</template>

<style lang="scss" scoped>
  .hero{
    width: 100%;

    display: flex;
    flex-direction: row;
    justify-content: space-between;

    padding: var(--size-spacing-m);
    margin-bottom: var(--size-spacing-xl);

    .theme-switch{
      label{
        cursor: pointer;
      }
      &__btn{
        display: none;
      }
    }
  }
</style>
