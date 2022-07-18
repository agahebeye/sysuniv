import { usePage } from "@inertiajs/inertia-vue3";
import { computed } from "vue";

export function useAuth() {
    const auth = usePage().props.value.auth['user'];

    const isAdmin = computed(() => auth.role === "ADMIN");
    const isEmployee = computed(() => auth.role === "EMPLOYEE");
    const isUniversity = computed(() => auth.role === "UNIVERSITY");

    return {
        auth,
        isAdmin,
        isEmployee,
        isUniversity,
    };
}
