import { onMounted, onUpdated, ref } from "vue";

export function useFilteredTitle(filters: any) {
    const title = ref('');

    onMounted(() => title.value = generateTitle())
    onUpdated(() => title.value = generateTitle())

    function generateTitle() {

        let temp = '';
        const levelList = ['BAC 1', 'BAC 2', 'BAC 3'];

        if (filters['gender']) temp += `${filters['gender']}(s) `.toLowerCase();
        if (filters['results.mention']) temp += `${filters['results.mention']} `.toLowerCase();
        if (filters['freshmen']) temp += `inscrit(s) cette année `;
        if (filters['registrations.start_date'] && filters['registrations.end_date']) temp += `inscrit(s) entre ${filters['registrations.start_date'] + ' et ' + filters['registrations.end_date']} `
        if (filters['registrations.level']) temp += `en ${levelList[filters['registrations.level']]} `;
        if (filters['universities.name']) temp += ` à ${filters['universities.name']} `
        if (filters['search']) temp += `dont le nom commence <strong>"${filters['search']}"</strong> `

        return temp;
    }

    return title;
}