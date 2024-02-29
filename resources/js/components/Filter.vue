<template>
  <div class="flex gap-x-4 gap-y-4 flex-col">
    <div class="flex flex-col items-start gap-y-4 lg:flex-row lg:items-cecnter lg:gap-x-4">
      <div class="relative h-10 w-10 min-w-[100px]">
        <input
          class="peer w-full h-full bg-transparent text-blue-gray-700 font-sans font-normal outline outline-0 focus:outline-0 disabled:bg-blue-gray-50 disabled:border-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 border focus:border-2 border-t-transparent focus:border-t-transparent text-sm px-3 py-2.5 rounded-[7px] border-blue-gray-200 focus:border-gray-900"
          placeholder=" "
          @keypress="validateInput($event)"
          v-model="client_id"
          v-on:keyup.enter="
            filterQuery(client_id == '' ? false : { client_id }, 'client_id')
          "
        /><label
          class="flex w-full h-full select-none pointer-events-none absolute left-0 font-normal !overflow-visible truncate peer-placeholder-shown:text-blue-gray-500 leading-tight peer-focus:leading-tight peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500 transition-all -top-1.5 peer-placeholder-shown:text-sm text-[11px] peer-focus:text-[11px] before:content[' '] before:block before:box-border before:w-2.5 before:h-1.5 before:mt-[6.5px] before:mr-1 peer-placeholder-shown:before:border-transparent before:rounded-tl-md before:border-t peer-focus:before:border-t-2 before:border-l peer-focus:before:border-l-2 before:pointer-events-none before:transition-all peer-disabled:before:border-transparent after:content[' '] after:block after:flex-grow after:box-border after:w-2.5 after:h-1.5 after:mt-[6.5px] after:ml-1 peer-placeholder-shown:after:border-transparent after:rounded-tr-md after:border-t peer-focus:after:border-t-2 after:border-r peer-focus:after:border-r-2 after:pointer-events-none after:transition-all peer-disabled:after:border-transparent peer-placeholder-shown:leading-[3.75] text-gray-500 peer-focus:text-gray-900 before:border-blue-gray-200 peer-focus:before:!border-gray-900 after:border-blue-gray-200 peer-focus:after:!border-gray-900"
          >ID клиента
        </label>
      </div>
      <div class="relative h-10 w-10 min-w-[200px]" v-if="role != 'Manager'">
        <select
          class="hover:cursor-pointer peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 empty:!bg-gray-900 focus:border-2 focus:border-gray-900 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
          @change="filterQuery(office == '' ? false : { office }, 'office')"
          v-model="office"
        >
          <option value="">Все</option>
          <option
            v-for="(currentOffice, id) in offices"
            :key="currentOffice"
            :value="id"
          >
            {{ currentOffice }}
          </option>
        </select>
        <label
          class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-400 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:border-gray-900 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:border-gray-900 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500"
        >
          Офис
        </label>
      </div>
      <div class="relative h-10 w-10 min-w-[200px]" v-if="role !='Manager'">
        <select
          class="hover:cursor-pointer peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 empty:!bg-gray-900 focus:border-2 focus:border-gray-900 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
          @change="
            filterQuery(manager_id == '' ? false : { manager_id }, 'manager_id')
          "
          v-model="manager_id"
        >
          <option value="">Все</option>
          <option
            v-for="(currentManager, id) in managers"
            :key="currentManager"
            :value="id"
          >
            {{ currentManager }}
          </option>
        </select>
        <label
          class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-400 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:border-gray-900 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:border-gray-900 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500"
        >
          Менеджер
        </label>
      </div>
      <div class="relative h-10 w-10 min-w-[200px]">
        <select
          class="hover:cursor-pointer peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 empty:!bg-gray-900 focus:border-2 focus:border-gray-900 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
          @change="
            filterQuery(lawyer_id == '' ? false : { lawyer_id }, 'lawyer_id')
          "
          v-model="lawyer_id"
        >
          <option value="">Все</option>
          <option
            v-for="(currentLawyer, id) in lawyers"
            :key="currentLawyer"
            :value="id"
          >
            {{ currentLawyer }}
          </option>
        </select>
        <label
          class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-400 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:border-gray-900 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:border-gray-900 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500"
        >
          Юрист
        </label>
      </div>
    </div>
    <div class="flex flex-col items-start gap-y-4 lg:flex-row lg:items-cecnter lg:gap-x-6">
      <div class="flex flex-col w-2/3">
        <p class="font-semibold text-sm mr-1.5 text-blueGray-700 mb-1">
          Месяц оплаты:
        </p>
        <DateSingle
          :query="'date'"
          @request="filterQuery"
          :currentDate="filters.date || ''"
        />
      </div>
      <div class="flex flex-col w-2/3">
        <p class="font-semibold text-sm mr-1.5 text-blueGray-700 mb-1">
          Дата передачи:
        </p>
        <DateRange
          :query="'dates_transfer'"
          @request="filterQuery"
          :currentDate="filters.dates_transfer || ''"
        />
      </div>
      <div class="flex flex-col">
        <p class="font-semibold text-sm mr-1.5 text-blueGray-700 mb-1">
          Дата оплаты:
        </p>
        <DateNumber :query="'dates_pay'" @request="filterQuery" :currentDate="filters.dates_pay || {0: '', 1: ''}" />
      </div>
      <Paginator />
    </div>
  </div>
</template>
<script>
import DateSingle from "./DateSingle";
import DateRange from "./DateRange";
import DateNumber from "./DateNumber"
import Paginator from "../components/Paginator"
export default {
  props: ["offices", "managers", "lawyers", "filters"],
  inject: ['role'],
  data() {
    return {
      date: "",
      datesTransfer: {
        start: "",
        end: "",
      },
      datesPay: {
        start: "",
        end: "",
      },
      office: "",
      manager_id: "",
      lawyer_id: "",
      client_id: "",
      formatter: {
        date: "DD MMM YYYY",
        month: "MMM",
      },
    };
  },
  components: {
    DateSingle,
    DateRange,
    DateNumber,
    Paginator
  },
  mounted() {
    this.office = this.getQuery("office") || "";
    this.manager_id = this.getQuery("manager_id") || "";
    this.lawyer_id = this.getQuery("lawyer_id") || "";
    this.client_id = this.getQuery("client_id" || "");
  },
  methods: {
    getQuery(query) {
        return this.route().params[query];
    },
    filterQuery(params, property) {
      let resultProps = Object.assign({ ...this.filters }, params, {page: 1});

      // Если нужно удалить какой-то query параметр
      if (!params) {
        const { [property]: foo, ...res } = resultProps;
        resultProps = res;
      }
      this.$inertia.get("/table", resultProps);
    },
    validateInput(event) {
      event = event ? event : window.event;
      var charCode = event.which ? event.which : event.keyCode;
      if (
        charCode > 31 &&
        (charCode < 48 || charCode > 57) &&
        charCode !== 46
      ) {
        event.preventDefault();
      } else {
        return true;
      }
    },
  },
};
</script>