<template>
    <ul class="list-group">
        <li class="list-group-item" v-for="todo in items">
            <input type="checkbox" @click="doneOrUndone(todo)" :value="todo" :checked="todo.done">
            <span v-bind:class="{strike:todo.done}">{{todo.item}}</span>
            <button class="btn btn-sm btn-danger pull-right" @click="deleteTodo(todo)"><i class="glyphicon glyphicon-trash"></i></button>
            <div class="clearfix"></div>
        </li>
    </ul>
</template>

<script>
import * as http from 'axios'
export default {
    props: ['todos'],
    data () {
        return {
            items: this.todos
        }
    },
    methods: {
        doneOrUndone: function (todo) {
            const done = !todo.done
            this.items[this.items.indexOf(todo)]["done"] = done

            http.put(`/todos/${todo.id}`, {done})
                .then((res)  => console.log(res.data))
                .catch((err) => console.log(err))
        },
        deleteTodo: function (todo) {
            if (confirm('Are you sure you want to delete this item?')) {
                var items = this.items
                http.delete(`/todos/${todo.id}`)
                    .then((res)  => Vue.delete(items, items.indexOf(todo)))
                    .catch((err) => console.log(err))
            }
        }
    }
}
</script>