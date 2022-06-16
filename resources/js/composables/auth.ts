import { usePage } from "@inertiajs/inertia-vue3";
import { computed } from "vue";

export function useAuth() {
    const authedUser = usePage().props.value.auth['user'];

    const isAdmin = computed(() => authedUser.role === "ADMIN");
    const isEmployee = computed(() => authedUser.role === "EMPLOYEE");
    const isUniversity = computed(() => authedUser.role === "UNIVERSITY");

    return {
        authedUser,
        isAdmin,
        isEmployee,
        isUniversity,
    };
}
