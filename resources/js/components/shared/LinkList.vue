<script lang="ts" setup>
import { Link } from '@inertiajs/inertia-vue3';
import { useAuth } from '~/composables/auth';
import EmployeeIcon from '~/../assets/icons/Employee.svg';
import UniversityIcon from '~/../assets/icons/University.svg';
import FacultyIcon from '~/../assets/icons/Faculty.svg';
import InstituteIcon from '~/../assets/icons/Institute.svg';
import DepartmentIcon from '~/../assets/icons/Department.svg';
import StudentIcon from '~/../assets/icons/Student.svg';

const { isAdmin, isEmployee } = useAuth();

const props = defineProps<{
    size: string
}>();

const sizeStyles = {
    'sm' : 'w-8 h-8',
    'lg': 'w-16 h-16'
}


</script>

<template>
    <div>
        <Link v-if="isAdmin" href="/employees">
        <EmployeeIcon :class="sizeStyles[size]"/>
        <span>employees</span>
        </Link>
        <Link v-if="isAdmin || isEmployee" href="/universities">
        <UniversityIcon :class="sizeStyles[size]"/>
        <span>universites</span>
        </Link>
        <Link href="/faculties">
        <FacultyIcon :class="sizeStyles[size]"/>
        <span>facultes</span>
        </Link>
        <Link href="/institutes">
        <InstituteIcon :class="sizeStyles[size]"/>
        <span>instituts</span>
        </Link>
        <Link href="/departments">
        <DepartmentIcon class="fill-white" :class="sizeStyles[size]"/>
        <span>Departements</span>
        </Link>
        <Link href="/students">
        <StudentIcon :class="sizeStyles[size]"/>
        <span>etudiants</span>
        </Link>
        <slot />
    </div>
</template>

<style scoped>
a {
    @apply uppercase flex items-center text-sm space-x-2  no-underline;
}
</style>