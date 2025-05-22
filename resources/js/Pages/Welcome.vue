<script setup>
import { Head, Link, usePage } from '@inertiajs/vue3';
import { ref, computed } from 'vue';
import StarRating from '../Components/StarRating.vue'

const props = defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
    recipes: Array,
    users: Array,
});

console.log(props.recipes)

const search = ref('');
const visibleCount = ref(12)

const filteredRecipes = computed(() => {
  return props.recipes.filter(r => {
    const titleMatch = r.title.toLowerCase().includes(search.value.toLowerCase());
    const chefMatch = r.user?.name?.toLowerCase().includes(search.value.toLowerCase());
    return titleMatch || chefMatch;
  });
});

const visibleRecipes = computed(() => {
  return filteredRecipes.value.slice(0, visibleCount.value)
})

function showMore() {
  visibleCount.value += 12
}

const sortedUsers = computed(() => {
return [...props.users].sort((a, b) => b.recipes_count - a.recipes_count);
});

function handleImageError() {
    document.getElementById('screenshot-container')?.classList.add('!hidden');
    document.getElementById('docs-card')?.classList.add('!row-span-1');
    document.getElementById('docs-card-content')?.classList.add('!flex-row');
    document.getElementById('background')?.classList.add('!hidden');
}
</script>

<template>
    <Head title="Welcome" />
    <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50 scroll-smooth">
        <img
            id="background"
            class="absolute -left-20 top-0 max-w-[877px]"
        />
        <div
            class="relative flex min-h-screen flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white"
        >
            <div 
            class="scroll-smooth opacity-0 translate-y-4 animate-slide-up bg-white shadow-md relative w-full max-w-2xl lg:max-w-full"
            >
              <div
                class="h-screen bg-cover bg-top rounded-t-lg px-4"
                style="background-image: url('https://images.unsplash.com/photo-1543363136-3fdb62e11be5?q=80&w=2080&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'); "
            >
                <header
                    class="grid grid-cols-2 items-center gap-2 pt-8 px-4 pb-2 lg:grid-cols-3"
                >
                    <div class=" font-dmserif text-xl text-white">
                        Tast-E-Book
                    </div>
                    <div class="font-parkinsans flex flex-row justify-center items-center space-x-8 text-white">
                        <!-- <div class="flex  lg:col-start-2 lg:justify-center">
                           Home
                        </div>
                        <div class="flex lg:col-start-2 lg:justify-center">
                            About
                        </div> 
                        <div class="flex lg:col-start-2 lg:justify-center">
                            Contact
                        </div>  -->
                    </div>
                    

                    <nav v-if="canLogin" class="-mx-3 flex flex-1 justify-end text-white">
                        <Link
                            v-if="$page.props.auth.user"
                            :href="route('dashboard')"
                            class="rounded-md px-3 py-2 ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                        >
                            Dashboard
                        </Link>
                        

                        <template v-else>
                            <Link
                                :href="route('login')"
                                class="rounded-md px-3 py-2  ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                            >
                                Log in
                            </Link>

                            <Link
                                v-if="canRegister"
                                :href="route('register')"
                                class="rounded-md px-3 py-2  ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                            >
                                Register
                            </Link>
                        </template>
                    </nav>
                </header>
                <section class="text-center mt-24">
                    <h1 class="text-9xl font-dmserif text-white mb-4 drop-shadow-md">
                        Tasty Food Collection
                    </h1>
                    <p class="text-lg text-white mb-8 max-w-xl mx-auto">
                        Explore a world of flavors and find your next favorite meal. Whether you’re a guest or a foodie, start your culinary adventure here.
                    </p>
                    <a href="#recipes">
                        <button class="bg-red-500 text-white px-6 py-2 rounded hover:bg-red-600 transition">
                            Explore recipes
                        </button>
                    </a>

                </section>
            </div>
                <main id="recipes" class="pt-10 bg-gradient-to-r from-red-50 via-white to-red-50 w-[100%] mx-auto">
                    <div class="max-w-[70%] mx-auto px-6 pb-12">
                        <section>
                        <h2 class="font-dmserif text-5xl font-semibold text-center text-yello-600 mb-6">Recipes</h2>
                        <input
                            type="text"
                            v-model="search"
                            placeholder="Search for recipes, ingredients, or chefs..."
                            class="w-full mb-8 max-w-md mx-auto p-3 rounded-full border border-white focus:outline-none focus:ring-0 focus:border-transparent shadow-md"
                        />

                        <div class="flex space-x-24">
                            <div class="flex flex-col justify-center">
 
                            <div
                                v-if="visibleRecipes.length"
                                class="flex-[7] min-w-[70%] grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8"
                            >
                                <div
                                v-for="recipe in visibleRecipes"
                                :key="recipe.id"
                                class="bg-white rounded shadow-lg overflow-hidden hover:shadow-gray-500 transition-shadow duration-300 flex flex-col"
                                >
                                <img
                                    :src="recipe.image"
                                    alt="Recipe image"
                                    class="w-full h-48 object-cover"
                                />

                                <div class="p-4 flex flex-col items-center text-center">
                                    <h3 class="text-lg font-bold text-black mb-1 truncate">
                                    {{ recipe.title }}
                                    </h3>
                                    <p class="text-sm italic text-black mb-4 truncate">
                                    By {{ recipe.user.name }}
                                    </p>

                                    <div class="text-yellow-600 font-semibold flex items-center space-x-1 select-none">
                                    <template v-if="recipe.ratings.length">
                                        <!-- <span>
                                        {{
                                            (
                                            recipe.ratings.reduce((acc, r) => acc + r.rating, 0) /
                                            recipe.ratings.length
                                            ).toFixed(1)
                                        }}
                                        </span> -->
                                        <!-- <span>★</span> -->
                                        <StarRating :rating="(
                                            recipe.ratings.reduce((acc, r) => acc + r.rating, 0) /
                                            recipe.ratings.length
                                            ).toFixed(1)" />
                                        <span>({{ recipe.ratings.length }} reviews)</span>

                                    </template>
                                    
                                    <span v-else>No ratings</span>
                                    </div>

                                </div>
                                </div>
                            </div>
                            <div v-else class=" min-w-[70%] text-yellow-700 text-center mt-12 text-lg">
                                <p>No recipes found. Try another search term!</p>
                        </div>  
                                                <button 
                            v-if="visibleCount < filteredRecipes.length" 
                            @click="showMore" 
                            class="mt-6 px-4 py-2 bg-yellow-400 text-white rounded hover:bg-yellow-500"
                        >
                            Show More
                        </button>                             
                            </div>

                            <div class="flex-[2] text-black ">
                                <div class="bg-white shadow-md py-8 px-8 w-[280px]">
                                    <div class="flex flex-row items-center justify-between mb-4">
                                        <h2 class="text-xl font-bold ">Top Users</h2>
                                        <button class="text-red-500"> VIEW ALL </button>
                                    </div>

                                    <ul class="pl-4">
                                    <li v-for="user in sortedUsers" :key="user.id" class="mb-2 flex items-center space-x-3 mb-4">
                                        <img 
                                        :src="`https://ui-avatars.com/api/?name=${encodeURIComponent(user.name)}&background=random&color=fff&size=64`"
                                        alt="User avatar"
                                        class="w-8 h-8 rounded-full object-cover"
                                        />
                                        <span>{{ user.name }}</span>

                                    </li>
                                    </ul>
                                </div>

                            </div>
                        </div>


                        </section>
                    </div>
                    </main>

                <footer
                    class="py-16 text-center text-sm text-black dark:text-white/70"
                >
                    Check more about us.
                </footer>
            </div>
        </div>
    </div>
</template>
