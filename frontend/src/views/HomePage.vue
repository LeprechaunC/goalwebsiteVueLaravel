<script setup>
import NavBar from "@/components/navigationbar/NavBar.vue";
</script>

<template>
  <NavBar />
  <div class="bg-white">
    <div class="relative isolate px-6 pt-14 lg:px-8">
      <div class="mx-auto max-w-2xl py-32 text-center sm:py-48 lg:py-56">
        <h1 class="text-heading-1 font-heading tracking-tight text-gray-900">
          Achieve Your Goals with GoalTracker
        </h1>
        <p class="mt-6 text-lg leading-8 text-gray-600">
          Set daily, weekly, and monthly goals, and track your progress towards success.
        </p>
        <div class="flex gap-4 mt-4 w-full justify-center">
          <router-link class="p-button" to="/set-goal">
            Get Started
          </router-link>

        </div>
      </div>
    </div>
  </div>

  <section class="mx-auto my-16 flex flex-col lg:flex-row items-center justify-between max-w-7xl px-6">
    <div class="w-full mb-8 lg:w-1/2 lg:pr-8 lg:mb-0">
      <h1 class="text-3xl font-bold mb-4">Stay Focused and Organized!</h1>
      <p class="text-lg">
        Create clear and actionable goals for every aspect of your life. Whether it's personal or professional, 
        we provide tools to define, track, and achieve your objectives effectively.
      </p>
    </div>
    <div class="w-full lg:w-1/2 lg:pl-8">
      <img
    
        alt="Goal dashboard screenshot"
        class="w-full rounded-xl shadow-xl ring-1 ring-gray-400/10"
      />
    </div>
  </section>

  <section class="mx-auto my-16 flex flex-col-reverse items-center justify-between max-w-7xl px-6 mb-40 lg:flex-row">
    <div class="w-full mt-8 lg:w-1/2 lg:pr-8 lg:mt-0">
      <img
       
        alt="Goal planning options"
        class="w-full rounded-xl shadow-xl ring-1 ring-gray-400/10"
      />
    </div>
    <div class="w-full lg:w-1/2 lg:pl-8">
      <h1 class="text-3xl font-bold mb-4">Advanced Goal Planning</h1>
      <p class="text-lg">
        Break down your goals into manageable steps and track your progress. Set deadlines, prioritize tasks, 
        and receive reminders to keep yourself on track.
      </p>
    </div>
  </section>
</template>
