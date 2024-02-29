<template>
  <vue-tailwind-datepicker
    @update:model-value="filterDate($event)"
    :weekdays-size="'min'"
    :as-single="true"
    v-model="dateValue"
    :shortcuts="false"
    :formatter="formatter"
    :input-classes="'w-80 hover:cursor-pointer rounded-lg'"
  />
</template>
  <script>
export default {
  props: ["query", "single", "currentDate"],
  data() {
    return {
      dateValue: "",
      formatter: {
        date: "YYYY-MM-DD",
        month: "MM",
      },
    };
  },
  methods: {
    filterDate(event) {
      this.$emit("request", event ? {date: event} : false, this.query);
    },
  },
};
</script>