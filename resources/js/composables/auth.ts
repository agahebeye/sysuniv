import { usePage } from "@inertiajs/inertia-vue3";
import { computed } from "vue";

const auth = usePage().props.value.auth as any;
const { user } = auth;

export function useAuth() {
    const isAdmin = computed(() => user.role === "admin");
    const isEmployee = computed(() => user.role === "employee");
    const isUniversity = computed(() => user.role === "university");

    return {
        isAdmin,
        isEmployee,
        isUniversity,
    };
}
