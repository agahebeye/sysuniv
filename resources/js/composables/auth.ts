import { usePage } from "@inertiajs/inertia-vue3";
import { computed } from "vue";

export function useAuth() {
    const auth = usePage().props.value.auth as any;
    const { user } = auth;
    
    const isAdmin = computed(() => user.role === "admin");
    const isEmployee = computed(() => user.role === "employee");
    const isUniversity = computed(() => user.role === "university");

    return {
        user,
        isAdmin,
        isEmployee,
        isUniversity,
    };
}
