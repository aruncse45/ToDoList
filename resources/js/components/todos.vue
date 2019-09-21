<template>
    <div >
        <table class="table">
        
            <tr v-for="(todo) in todos">
	            <td class="text-left">
	                {{todo.title}}
	            </td>
	          
	           	<td class="text-right">
	                <button v-on:click="doneTask(todo.id)" class="btn btn-success">Done</button>
	                <button v-on:click="deleteTask(todo.id)" class="btn btn-danger">Delete</button>
	            </td>
              
            </tr>
            
        </table>
        
        <form v-on:submit.prevent="addTask">
	        <div class="form-group row">
			    <label for="inputPassword" class="col-sm-2 col-form-label">Task</label>
				    <div class="col-sm-10">
				      <input v-model="title" type="Text" class="form-control" id="inputPassword" placeholder="What do you need to do?">
				    </div>
			</div>
			
    		<div class="text-right">
   				<button type="submit" class="btn btn-primary">Save Item</button>
			</div>
		</form>
    </div>
        
</template>

<script >

import axios from 'axios'
  
  export default {
   
    data () {
      return {
        todos: [],
        id: 1,
        title: '',
        status:''
        
      }
    },
    mounted () {
      this.getTasks()
    },
    methods: {
      getTasks () {
        axios.get('api/getTask').then(
          (res) => {
          
            this.todos = res.data
			console.log(this.id)
          },
          
        )
      },

	  addTask () {
	    axios.post('api/addTask',
	        { title: this.title }
	        ).then((res) => {
	        this.title=''
	        this.getTasks()
	      
	    })
	  },

    doneTask (id) {
      axios.put(`api/doneTask/${id}`,
        
      ).then((res) => {
        
        this.getTasks()
       
      })
    },

    deleteTask(id){
      axios.delete(`api/deleteTask/${id}` ) 
      .then((res) => {
          
          this.getTasks()
        
        })
      }

    }

  }
  </script>
