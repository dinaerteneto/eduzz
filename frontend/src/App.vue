<template>
    <section>
        <section>

            <div class="body-content">

                <div class="container">
                  <person></person>
                </div>

                <footer>
                    2018 © Eduzz
                </footer>
            </div>
        </section>
        <section>

        </section>
    </section>
</template>
<script>
  import Person from './Person.vue';

  export default {
    components: {
      person: Person
    }

  }
</script>
