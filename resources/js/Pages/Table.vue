<template>
  <div class="w-full xl:w-5/6 mb-12 xl:mb-0 px-4 mx-auto mt-24 bg-blueGray-50">
    <button
      class="mb-3 float-right select-none font-sans font-bold text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 px-6 rounded-lg bg-gray-900 text-white shadow-md shadow-gray-900/10 hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none"
      type="button"
      @click="logout"
    >
      Выйти
    </button>
    <div
      class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded"
    >
      <div class="rounded-t mb-0 px-4 py-3 border-0">
        <div class="flex flex-col gap-y-4">
          <div class="relative w-full px-4 max-w-full flex-grow flex-1">
            <h3 class="font-semibold text-base text-blueGray-700">
              Таблица клиентов
            </h3>
          </div>
          <Filter
            :offices="offices"
            :managers="managers"
            :lawyers="lawyers"
            :filters="filters"
          ></Filter>
        </div>
      </div>
      <div class="block w-full overflow-x-auto">
        <table class="items-center bg-transparent w-full border-collapse">
          <thead>
            <tr>
              <th
                class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                v-if="role != 'Manager'"
                >
                Офис и менеджер
              </th>
              <th
                class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
              >
                Юрист
              </th>
              <th
                class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
              >
                ФИО Клиента
              </th>
              <th
                class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                v-if="role != 'Manager'"
              >
                Программа
              </th>
              <th
                class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
              >
                Дата регистрации
              </th>
              <th
                class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
              >
                План
              </th>
              <th
                class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
              >
                Стоимость программы
              </th>
              <th
                class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
              >
                В месяц
              </th>
              <th
                class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
              >
                Даты оплаты
              </th>
              <th
                class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
              >
                Дата передачи
              </th>
            </tr>
          </thead>
          <tbody>
            <TableData
              :offices="offices"
              :managers="managers"
              :lawyers="lawyers"
              :payPlanItem="payPlanItem"
              :filters="filters"
              @openModal="showModal"
            />
          </tbody>
        </table>
      </div>
    </div>
    <PaymentModal :showing="isOpen" @close="closeModal" :data="paymentData" />
  </div>
</template>
<script>
import Filter from "../components/Filter";
import TableData from "../components/TableData";
import PaymentModal from "../components/PaymentModal";
export default {
  provide() {
    return {
      paginatorData: this.paginatorData,
      role: this.role
    };
  },
  props: [
    "offices",
    "managers",
    "lawyers",
    "payPlanItem",
    "filters",
    "user",
    "role",
  ],
  data() {
    return {
      isOpen: false,
      paymentData: {},
    };
  },
  methods: {
    logout() {
      this.$inertia.post("/logout");
    },
    showModal(data) {
      this.paymentData = data;
      this.isOpen = true;
    },
    closeModal() {
      this.isOpen = false;
      this.paymentData = {};
    },
  },
  computed: {
    paginatorData() {
      return {
        currentPage: this.payPlanItem.current_page,
        lastPage: this.payPlanItem.prev_page_url,
        nextPage: this.payPlanItem.next_page_url,
      };
    },
  },
  components: {
    Filter,
    TableData,
    PaymentModal,
  },
};
</script>