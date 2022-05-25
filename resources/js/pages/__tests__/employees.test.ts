import {mount} from '@vue/test-utils';
import Index from '~/pages/employees/index.vue';
const {describe, it, expect} = await import('vitest');

describe('employees', () => {
    it('can see employees', async () => {
        expect(Index).toBeTruthy();
        //const wrapper = mount(Index);

    })
})
