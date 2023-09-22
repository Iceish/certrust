<script setup>
import TheHeader from "@/components/TheHeader.vue";
import TheHero from "@/components/TheHero.vue";
</script>

<template>
  <div id="layout">
    <TheHeader/>
    <main>
      <TheHero/>
      <slot/>
    </main>
  </div>
</template>

<style scoped lang="scss">
  #layout{
    height: 100vh;
    display: grid;
    grid-template-columns: auto 1fr;

    background-color: var(--clr-background);
    color: var(--clr-text);
  }

  main{
    height: 100%;
    width: 100%;

    display: flex;
    flex-direction: column;

    gap: var(--size-spacing-l);
    padding: var(--size-spacing-m);

    overflow-y: auto;

    #section-title{
      color: var(--clr-secondary);
      font-size: 2rem;
      font-weight: var(--weight-font-bold);
    }
  }
</style>