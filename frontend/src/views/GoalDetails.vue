<template>
         <NavBar />
    <div class="goal-details flex flex-col items-center p-5">
  
      <div class="content bg-white p-6 rounded-lg shadow-lg max-w-xl w-full">
        <h1 class="text-2xl font-bold mb-4">{{ goal.title }}</h1>
        <p class="mb-2"><strong>Date:</strong> {{ goal.date }}</p>
        <p class="mb-4"><strong>Description:</strong> {{ goal.description || "No description provided." }}</p>
        <button @click="$router.push('/goals')" class="mt-2 px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
          Back to Calendar
        </button>
      </div>
    </div>
  </template>
  
  <script>
  import { defineComponent, ref, onMounted } from "vue";
  import { useRoute } from "vue-router";
  import axios from "axios";
  import NavBar from "@/components/navigationbar/NavBar.vue";
  
  export default defineComponent({
    components: { NavBar },
    setup() {
      const route = useRoute();
      const goal = ref({});
  
      onMounted(async () => {
        try {
          const response = await axios.get(`http://localhost:8000/api/goals/${route.params.id}`);
          goal.value = response.data;
        } catch (error) {
          console.error("Error fetching goal details:", error);
        }
      });
  
      return { goal };
    },
  });
  </script>
  
 