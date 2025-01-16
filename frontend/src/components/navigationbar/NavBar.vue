<template>
  <header>
    <nav>
      <div class="flex justify-between items-center h-16 px-10 shadow bg-white">
        <!-- Logo and Navigation Links -->
        <div class="flex items-center space-x-8">
          <h1 class="text-xl font-bold text-black cursor-pointer">GoalTracker</h1>

          <!-- Desktop Menu -->
          <div class="hidden md:flex space-x-4">
            <a href="#" class="text-gray-700 hover:text-black relative group">
              Daily Goals
              <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-black transition-all group-hover:w-full"></span>
            </a>
            <a href="#" class="text-gray-700 hover:text-black relative group">
              Weekly Goals
              <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-black transition-all group-hover:w-full"></span>
            </a>
            <a href="#" class="text-gray-700 hover:text-black relative group">
              Monthly Goals
              <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-black transition-all group-hover:w-full"></span>
            </a>
          </div>
        </div>

        <!-- User Account Links (Desktop Only) -->
        <div class="hidden md:flex">
          <HeaderButtons />
        </div>

        <!-- Mobile Menu Button -->
        <div class="md:hidden">
          <button @click="isOpen = !isOpen" class="text-gray-800 focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
            </svg>
          </button>
        </div>
      </div>

      <!-- Mobile Menu Dropdown -->
      <div v-if="isOpen" class="md:hidden bg-white shadow-lg px-6 py-4 space-y-2">
        <a href="#" class="block text-gray-700 hover:text-black">Daily Goals</a>
        <a href="#" class="block text-gray-700 hover:text-black">Weekly Goals</a>
        <a href="#" class="block text-gray-700 hover:text-black">Monthly Goals</a>

        <!-- User Account Links in Mobile View -->
        <div class="border-t mt-2 pt-2">
          <HeaderButtons class="px-1" />
        </div>
      </div>
    </nav>

    <!-- Edit Profile Popup -->
    <EditProfileModal v-if="isEditProfileOpen" @close="closeEditProfile" />
  </header>
</template>

<script setup>
import { ref } from 'vue';
import HeaderButtons from '@/components/HeaderButtons.vue';
import EditProfileModal from '@/components/EditProfileModal.vue';

const isEditProfileOpen = ref(false);
const user = ref(null); // Store user data here

const openEditProfile = async () => {
  // Fetch user data from backend when the modal is opened
  try {
    const response = await fetch('http://localhost:8000/api/user');
    if (response.ok) {
      user.value = await response.json();
    }
  } catch (error) {
    console.error('Failed to fetch user data:', error);
  }

  isEditProfileOpen.value = true;
};

const closeEditProfile = () => {
  isEditProfileOpen.value = false;
};

// Manage the mobile menu open/close state
const isOpen = ref(false);
</script>

<style scoped>
/* Custom underline animation */
.group:hover span {
  width: 100%;
}
</style>
