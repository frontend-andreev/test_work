<template>
  <vue-tailwind-datepicker
    @update:model-value="filterDate($event)"
    :weekdays-size="'min'"
    v-model="dateValue"
    :shortcuts="false"
    :formatter="formatter"
    :input-classes="'w-80 hover:cursor-pointer rounded-lg'"
  />
</template>
<script>
export default {
  props: ["query", "currentDate"],
  data() {
    return {
      dateValue: "",
      formatter: {
        date: "YYYY-MM-DD",
        month: "MM",
      },
    };
  },
  mounted() {
    this.dateValue = this.currentDate;
  },
  methods: {
    filterDate(event) {
      let dates = event
      if (event.length && !Array.isArray(event)) {
         dates = event.split(" ~ ");
      }
      this.$emit("request", event.length ? { dates_transfer: dates } : false, this.query);
    },
  },
};
</script>