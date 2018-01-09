<template>
  <div class="body-content">

      <div class="container">
        <top></top>
        <person></person>
      </div>

      <footer>
          <div class="pull-right">2018 © Eduzz - By Dinaerte Neto (dinaerteneto@gmail.com)</div>
      </footer>
  </div>
</template>
<script>
  import Header from './Header.vue';
  import Person from './Person.vue';

  export default {
    components: {
      top: Header,
      person: Person
    }

  }
</script>
