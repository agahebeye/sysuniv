import { usePage } from "@inertiajs/inertia-vue3";
import { computed } from "vue";

export function useAuth() {
    const auth = usePage().props.value.auth as any;
    const { user } = auth;
    
    const isAdmin = computed(() => user.role === "ADMIN");
    const isEmployee = computed(() => user.role === "EMPLOYEE");
    const isUniversity = computed(() => user.role === "UNIVERSITY");

    return {
        user,
        isAdmin,
        isEmployee,
        isUniversity,
    };
}
