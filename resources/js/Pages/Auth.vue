<template>
  <div
    class="min-h-screen bg-blue-100 flex items-center justify-center text-gray-500 text-sm"
  >
    <form
      class="bg-white shadow-lg rounded-md p-5 md:p-10 flex flex-col w-11/12 max-w-lg group"
      @submit.prevent="submitFunc"
      novalidate
    >
      <label for="email" class="mb-5">
        <span>Email</span>
        <input
          type="email"
          name="email"
          id="email"
          v-model="email"
          class="w-full rounded border border-gray-300 bg-inherit p-3 shadow shadow-gray-100 mt-2 appearance-none outline-none text-neutral-800 invalid:[&:not(:placeholder-shown):not(:focus)]:border-red-500"
          :class="{ 'border-red-500': error }"
          @focus="error = false"
          placeholder="Type your Email"
          required
          pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
        />
        <span
          class="mt-2 hidden text-sm text-red-500 peer-[&:not(:placeholder-shown):not(:focus):invalid]:block"
        >
          Please enter a valid email address
        </span>
      </label>
      <label for="password" class="mb-5">
        <span>Password</span>
        <input
          type="password"
          name="password"
          id="password"
          v-model="password"
          class="w-full rounded border border-gray-300 bg-inherit p-3 shadow shadow-gray-100 mt-2 appearance-none outline-none text-neutral-800 invalid:[&:not(:placeholder-shown):not(:focus)]:border-red-500"
          :class="{ 'border-red-500': error }"
          @focus="error = false"
          placeholder="Type your password"
          required
          pattern=".{6,}"
        />
      </label>
      <button
        type="submit"
        class="mt-5 bg-blue-500 py-3 rounded-md text-white group-invalid:pointer-events-none group-invalid:opacity-30"
      >
        Login
      </button>
    </form>
  </div>
</template>
<script>
import { Inertia } from "@inertiajs/inertia";
export default {
  data() {
    return {
      email: "",
      password: "",
      requestURL: route("login"),
      error: false,
    };
  },
  methods: {
    submitFunc() {
      let data = {
        email: this.email,
        password: this.password,
      };
      Inertia.post("/login", data, {
        onSuccess: (res) => {
            if (res.component == 'Auth') {
                this.error = true
            }
        },
        onError: (errors) => {
          console.log(errors);
        },
      });
    },
  },
};
</script>

