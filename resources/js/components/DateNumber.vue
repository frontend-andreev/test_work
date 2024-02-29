<template>
  <div class="flex items-center gap-x-4">
    <select
      class="hover:cursor-pointer peer h-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 empty:!bg-gray-900 focus:border-2 focus:border-gray-900 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
      @change="selectDate"
      v-model="value[0]"
    >
      <option value="">-</option>
      <option v-for="number in 31" :key="number" :value="number">
        {{ number }}
      </option>
    </select>
    <p>и</p>
    <select
      class="hover:cursor-pointer peer h-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 empty:!bg-gray-900 focus:border-2 focus:border-gray-900 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
      @change="selectDate"
      v-model="value[1]"
    >
      <option value="">-</option>
      <option v-for="number in 31" :key="number" :value="number">
        {{ number }}
      </option>
    </select>
  </div>
</template>
<script>
export default {
  props: ["query", "currentDate"],
  data() {
    return {
      value: {
        0: "",
        1: "",
      },
    };
  },
  mounted() {
    this.value = this.currentDate;
  },
  methods: {
    selectDate() {
      if (this.value[0] && this.value[1]) {
        this.$emit(
          "request",
          this.value[0] && this.value[1]
            ? { dates_pay: [this.value[0], this.value[1]] }
            : false,
          this.query
        );
      } else if (!this.value[0] && !this.value[1]) {
        this.$emit(
          "request",
          this.value[0] && this.value[1]
            ? { dates_pay: [this.value[0], this.value[1]] }
            : false,
          this.query
        );
      }
    },
  },
};
</script>