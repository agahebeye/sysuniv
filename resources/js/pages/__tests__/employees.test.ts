import {mount} from '@vue/test-utils';
import Index from '~/pages/employees/index.vue';
import {User} from '~/types/users';

const {describe, it, expect} = await import('vitest');

describe('employees', () => {
    it('can see employees', async () => {
        expect(Index).toBeTruthy();

        const wrapper = mount(Index, {props: {
            employees: []
        }});
        expect(wrapper.findAll('[data-test="employee"]')).toHaveLength(0);

        await wrapper.setProps({
            employees: [{
                id: 1,
                name: 'gahebeye'
            }] as User[]
        });

        expect(wrapper.get('[data-test="employee"]').text()).toBe('gahebeye');
        expect(wrapper.findAll('[data-test="employee"]')).toHaveLength(1);
    })
})
