import { defineStore } from 'pinia';
import echo from "@/echo";
import { User } from "@/types";
import { onMounted, onUnmounted, ref } from "vue";

export const usePresenceStore = defineStore('', () => {
    const users = ref<User[]>([]);

    onMounted(() => {
        echo.join('presence-jetete')
            .here((onlineUsers: User[]) => {
                users.value = onlineUsers;
            }).joining((user: User) => {
                users.value.push(user);
            }).leaving((user: User) => {
                users.value = users.value.filter(u => u.id != user.id);
            });
    });

    onUnmounted(() => {
        echo.leave('presence-jetete');
    });

    return { users }
});
