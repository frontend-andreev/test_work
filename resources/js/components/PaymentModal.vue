<template>
    <div
      v-if="showing"
      class="fixed inset-0 w-full h-screen flex items-center justify-center bg-zinc-900/75"
    >
      <div class="relative w-full max-w-2xl bg-white shadow-lg rounded-lg p-8">
        <button
          aria-label="close"
          class="absolute top-0 right-0 text-xl text-gray-500 my-2 mx-4"
          @click.prevent="close"
        >
          &times;
        </button>
        <p class="font-xl font-bold">Список платежей:</p>
        <ul>
            <li class="flex items-center gap-x-2 text-base" v-for="item in data" :key="item">
                <p>{{ item.amount }}</p>
                <span>&#8212</span>
                <p>{{ item.date }}</p>
            </li>
        </ul>
      </div>
    </div>
  </template>
  
  <script>
export default {
  props: {
    showing: {
      required: true,
      type: Boolean,
    },
    data: {
      required: true,
      type: Object,
    },
  },
  mounted() {
    console.log(this.showing);
  },
  methods: {
    close() {
      this.$emit("close");
    },
  },
};
</script>