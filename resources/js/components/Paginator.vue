<template>
  <div class="flex items-center self-end gap-x-4 justify-end w-full">
    <svg
    @click="$inertia.get('/table', {page: paginatorData.currentPage - 1})"
    class="h-8 w-8 text-black hover:cursor-pointer"
      :class="{
        'text-gray-400': !paginatorData.lastPage,
        'pointer-events-none': !paginatorData.lastPage,
      }"
      fill="none"
      viewBox="0 0 24 24"
      stroke="currentColor"
    >
      <path
        stroke-linecap="round"
        stroke-linejoin="round"
        stroke-width="2"
        d="M10 19l-7-7m0 0l7-7m-7 7h18"
      />
    </svg>
    <p>{{ paginatorData.currentPage }}</p>
    <svg
    @click="$inertia.get('/table', {page: paginatorData.currentPage + 1})"
      class="h-8 w-8 text-black hover:cursor-pointer"
      :class="{
        'text-gray-400': !paginatorData.nextPage,
        'pointer-events-none': !paginatorData.nextPage,
      }"
      fill="none"
      viewBox="0 0 24 24"
      stroke="currentColor"
    >
      <path
        stroke-linecap="round"
        stroke-linejoin="round"
        stroke-width="2"
        d="M14 5l7 7m0 0l-7 7m7-7H3"
      />
    </svg>
  </div>
</template>
<script>
export default {
  inject: ["paginatorData"],
};
</script>