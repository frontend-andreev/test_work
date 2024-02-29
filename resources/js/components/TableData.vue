<template>
  <tr v-for="item in payPlanItem.data" :key="item.id">
    <th
      class="flex items-center gap-x-4 border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left text-blueGray-700"
      v-if="role != 'Manager'"
    >
      <p>{{ item.manager.office }}</p>
      <span>&#8212</span>
      <select
        class="peer hover:cursor-pointer border-none h-full w-auto rounded-[7px] bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all empty:!bg-gray-900 focus:border-2 focus:border-gray-900 focus:outline-0 disabled:bg-blue-gray-50"
        @change="
          updateData({
            id: item.id,
            manager_id: $event.target.value,
          })
        "
      >
        <option
          v-for="(currentManager, id) in managers"
          :key="currentManager"
          :value="id"
          :selected="item.manager.id == id"
        >
          {{ currentManager }}
        </option>
      </select>
    </th>
    <td
      class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4"
    >
      <select
        class="peer hover:cursor-pointer border-none h-full w-auto rounded-[7px] bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all empty:!bg-gray-900 focus:border-2 focus:border-gray-900 focus:outline-0 disabled:bg-blue-gray-50"
        @change="
          updateData({
            id: item.id,
            lawyer_id: $event.target.value,
          })
        "
      >
        <option
          v-for="(currentLawyer, id) in lawyers"
          :key="currentLawyer"
          :value="id"
          :selected="item.lawyer.id == id"
        >
          {{ currentLawyer }}
        </option>
      </select>
    </td>
    <td
      class="border-t-0 px-6 align-center border-l-0 border-r-0 text-xs whitespace-nowrap p-4"
    >
      <p contenteditable="true" @blur="updateData({id: item.id, name: $event.target.innerText})">
        {{ item.client_name }}
      </p>
    </td>
    <td
      class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4"
      v-if="role != 'Manager'"
    >
      <p>{{ item.program_type }}</p>
    </td>
    <td
      class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4"
    >
      <p>{{ item.date_register }}</p>
    </td>
    <td
      class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4"
    >
      <p>{{ item.program_plan }} / {{ item.all_payments }}</p>
    </td>
    <td
      class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4"
    >
      <p>{{ item.program_price }} / {{ item.all_payments }}</p>
    </td>
    <td
      class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4"
    >
    <div class="flex flex-items gap-x-2">
      <p>
      {{ item.program_payment_per_month }}
    </p>
    <p class="hover:cursor-pointer font-bold text-red-500" @click="$emit('openModal', item.payment_select)">
      {{
        Object.entries(item.payment_select).length
          ? `/ ${paymentSum(item.payment_select)}`
          : ""
      }}
    </p>
    </div>
    </td>
    <td
      class="flex items-center gap-x-2 border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4"
    >
      <p :contenteditable="role != 'Manager'" @blur="updateData({id: item.id, first_date: $event.target.innerText})">
        {{ item.program_first_date }},
      </p>
      <p :contenteditable="role != 'Manager'" @blur="updateData({id: item.id, second_date: $event.target.innerText})">
        {{ item.program_second_date }}
      </p>
    </td>
    <td
      class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4"
    >
     <p>{{ item.client_handover_date }}</p>
    </td>
  </tr>
</template>
<script>
export default {
  inject: ["role"],
  props: ["offices", "managers", "lawyers", "payPlanItem", "filters"],
  data() {},
  methods: {
    paymentSum(obj) {
      const sumValues = (obj) =>
        Object.values(obj).reduce((a, b) => {
          return a + Number(b.amount);
        }, 0);
      return sumValues(obj);
    },
    updateData(someData) {
      this.$inertia.post("/update-data", someData, {
        onError: (errors) => {
          console.log(errors);
        },
      });
    },
  },
};
</script>