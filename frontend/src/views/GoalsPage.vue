<template>
  <NavBar />
  <div class="calendar-toolbar">
    <button @click="changeView('dayGridMonth')">Month</button>
    <button @click="changeView('timeGridWeek')">Week</button>
    <button @click="changeView('timeGridDay')">Day</button>
  </div>
  <FullCalendar
    class="calendar"
    ref="calendarRef"
    :options="calendarOptions"
  />

  <!-- Modal for creating a goal -->
  <div v-if="showModal" class="modal-overlay" @click="closeModal">
    <div class="modal-content" @click.stop>
      <h3>Enter your goal for {{ selectedDate }}</h3>
      <input v-model="goalTitle" type="text" placeholder="Enter your goal" />
      <textarea v-model="goalDescription" placeholder="Enter description"></textarea>
      <button @click="saveGoal">Save Goal</button>
      <button @click="closeModal">Cancel</button>
    </div>
  </div>
</template>

<script>
import { defineComponent, reactive, ref } from "vue";
import { useRouter } from "vue-router";
import FullCalendar from "@fullcalendar/vue3";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";
import interactionPlugin from "@fullcalendar/interaction";
import axios from "axios";
import NavBar from "@/components/navigationbar/NavBar.vue";

export default defineComponent({
  components: { FullCalendar, NavBar },
  setup() {
    const router = useRouter();
    const showModal = ref(false);
    const selectedDate = ref(null);
    const goalTitle = ref("");
    const goalDescription = ref("");
    const calendarRef = ref(null);

    // Fetch goals from the backend
    const fetchEvents = async (fetchInfo, successCallback, failureCallback) => {
      try {
        const response = await axios.get("http://localhost:8000/api/goals");
        successCallback(response.data);
      } catch (error) {
        failureCallback(error);
      }
    };

    const calendarOptions = reactive({
      headerToolbar: {
    left: 'prev,next today', // Added 'today' button here
    center: 'title',
    right: 'dayGridMonth,dayGridWeek,dayGridDay'
  },
      plugins: [
        dayGridPlugin,
        timeGridPlugin,
        interactionPlugin
      ],
      initialView: "dayGridWeek",
      events: fetchEvents,
      dateClick: (info) => {
        selectedDate.value = info.dateStr;
        showModal.value = true;
      },
      eventClick: (info) => {
        router.push(`/goal/${info.event.id}`);
      },
    });

    const changeView = (view) => {
      if (calendarRef.value) {
        const calendarApi = calendarRef.value.getApi();
        calendarApi.changeView(view);
      }
    };

    const closeModal = () => {
      showModal.value = false;
      goalTitle.value = "";
      goalDescription.value = "";
    };

    const saveGoal = async () => {
      if (!goalTitle.value) {
        alert("Please enter a goal title.");
        return;
      }

      try {
        await axios.post("http://localhost:8000/api/goals", {
          title: goalTitle.value,
          description: goalDescription.value.trim() || null,
          date: selectedDate.value,
        });

        alert("Goal saved!");
        closeModal();

        if (calendarRef.value) {
          calendarRef.value.getApi().refetchEvents();
        }
      } catch (error) {
        console.error("Error saving goal:", error);
        alert("Failed to save goal.");
      }
    };

    return {
      showModal,
      selectedDate,
      goalTitle,
      goalDescription,
      calendarOptions,
      closeModal,
      saveGoal,
      calendarRef,
      changeView,
    };
  },
});
</script>


<style scoped>
.calendar {
  padding: 5%;
}
.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 99;
}

.modal-content {
  background-color: white;
  padding: 20px;
  border-radius: 8px;
  display: flex;
  flex-direction: column;
  gap: 10px;
  width: 300px;
}

.modal-content input {
  padding: 10px;
  font-size: 14px;
  border-radius: 4px;
}

.modal-content button {
  padding: 10px;
  background-color: #4CAF50;
  color: white;
  border: none;
  cursor: pointer;
}

.modal-content button:hover {
  background-color: #45a049;
} 
</style>
