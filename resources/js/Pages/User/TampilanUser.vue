<template>
    <div class="overflow-x-auto max-w-7xl m-auto mt-10">
        <div class="flex justify-center">
            <h1 class="font-bold text-3xl mb-10">MANAGE YOUR ACCOUNT</h1>
        </div>
        <div class="flex justify-between mb-4">
            <input
                v-model="searchQuery"
                type="text"
                placeholder="Cari nama akun..."
                class="input input-bordered w-full max-w-xs"
            />
            <Link class="btn btn-info" href="/users/create" as="button"
                >Tambah Akun</Link
            >
        </div>
        <table class="table">
            <thead>
                <tr class="bg-blue-200">
                    <th>No</th>
                    <th>Nama Akun</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Nomor HP</th>
                    <th>Password</th>
                    <th class="px-0"></th>
                </tr>
            </thead>
            <tbody>
                <tr
                    v-for="(users, index) in filteredUsers"
                    :key="users.id"
                    class="hover"
                >
                    <th>{{ index + 1 }}</th>
                    <td>{{ users.name }}</td>
                    <td>{{ users.username }}</td>
                    <td>{{ users.email }}</td>
                    <td>{{ users.nomor }}</td>
                    <td>{{ users.password }}</td>
                    <td class="px-0 w-56">
                        <Link
                            :href="`/users/${users.id}/edit`"
                            class="btn btn-warning mr-4"
                            as="button"
                            >Edit</Link
                        >
                        <Link
                            :href="`/users/${users.id}`"
                            method="delete"
                            class="btn btn-error mr-4"
                            as="button"
                            >Hapus</Link
                        >
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import { ref, computed } from "vue";

const props = defineProps({
    users: {
        type: Array,
        default: () => [],
    },
});

const searchQuery = ref("");
const filteredUsers = computed(() => {
    return props.users.filter((user) =>
        user.name.toLowerCase().includes(searchQuery.value.toLowerCase())
    );
});
</script>

