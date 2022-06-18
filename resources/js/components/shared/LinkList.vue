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
        <span>universities</span>
        </Link>
        <Link href="/faculties">
        <FacultyIcon :class="sizeStyles[size]"/>
        <span>faculties</span>
        </Link>
        <Link href="/institutes">
        <InstituteIcon :class="sizeStyles[size]"/>
        <span>institutes</span>
        </Link>
        <Link href="/departments">
        <DepartmentIcon class="fill-white" :class="sizeStyles[size]"/>
        <span>Departments</span>
        </Link>
        <Link href="/students">
        <StudentIcon :class="sizeStyles[size]"/>
        <span>students</span>
        </Link>
    </div>
</template>

<style scoped>
a {
    @apply flex items-center space-x-2 capitalize no-underline;
}

svg {
}
</style>