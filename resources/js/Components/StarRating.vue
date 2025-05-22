<!-- StarRating.vue -->
<template>
  <div class="flex items-center">
    <template v-for="i in 5" :key="i">
      <svg
        v-if="i <= fullStars"
        class="w-5 h-5 text-yellow-400"
        fill="currentColor"
        viewBox="0 0 20 20"
      >
        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.28 3.946h4.149c.969 0 1.371 1.24.588 1.81l-3.36 2.44 1.28 3.946c.3.921-.755 1.688-1.54 1.118l-3.36-2.44-3.36 2.44c-.785.57-1.84-.197-1.54-1.118l1.28-3.946-3.36-2.44c-.784-.57-.38-1.81.588-1.81h4.149l1.28-3.946z" />
      </svg>

      <svg
        v-else
        class="w-5 h-5 text-gray-300"
        fill="currentColor"
        viewBox="0 0 20 20"
      >
        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.28 3.946h4.149c.969 0 1.371 1.24.588 1.81l-3.36 2.44 1.28 3.946c.3.921-.755 1.688-1.54 1.118l-3.36-2.44-3.36 2.44c-.785.57-1.84-.197-1.54-1.118l1.28-3.946-3.36-2.44c-.784-.57-.38-1.81.588-1.81h4.149l1.28-3.946z" />
      </svg>
    </template>
  </div>
</template>

<script setup>
const props = defineProps({
  rating: {
    type: Number,
    required: true,
  },
})

// Round the rating to the nearest integer
const fullStars = Math.round(props.rating)
</script>
