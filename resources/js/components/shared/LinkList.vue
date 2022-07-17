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
        <EmployeeIcon class="w-8 h-8 text-black"/>
        <span>employés</span>
        </Link>
        <Link v-if="isAdmin || isEmployee" href="/universities">
        <UniversityIcon class="w-8 h-8 text-black"/>
        <span>universités</span>
        </Link>
        <Link href="/faculties">
        <FacultyIcon class="w-8 h-8 text-black"/>
        <span>facultés</span>
        </Link>
        <Link href="/institutes">
        <InstituteIcon class="w-8 h-8 text-black"/>
        <span>instituts</span>
        </Link>
        <Link href="/departments">
        <DepartmentIcon class="w-8 h-8 text-black"/>
        <span>Départements</span>
        </Link>
        <Link href="/students">
        <StudentIcon class="w-8 h-8 text-black"/>
        <span>etudiants</span>
        </Link>
        <slot />
    </div>
</template>

<style scoped>
a {
    @apply flex items-center capitalize space-x-2  no-underline;
    @apply w-max;
}
</style>