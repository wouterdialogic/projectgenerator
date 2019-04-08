<template>
  <div class="hello">
   
  
  <hr /><br>
  <h2>{{user_instruction}}</h2><br>
    <h3>Columns and rows</h3><br>
    <input
      type="number"
      name="grid_columns"
      id="grid_columns"
      placeholder="columns"
      style="width:100px;"
      class="bg-grey-lighter appearance-none order-2-2 order-2-grey-lighter rounded w-full py-2 px-4 text-grey-darker leading-tight focus:outline-none focus:bg-white focus:order-2-purple"
      v-model="grid_columns"
    /> - 
    <input type="number" 
    style="width:100px;"
    placeholder="rows"
    class="bg-grey-lighter appearance-none order-2-2 order-2-grey-lighter rounded w-full py-2 px-4 text-grey-darker leading-tight focus:outline-none focus:bg-white focus:order-2-purple"
    v-model="grid_rows" />

<br><br>
  <h3>Classes:</h3><br>
  <input
          v-model.lazy="form['all']"
          :name="'allcontroller'"
          :key="'allcontroller'"
          style="width:100px;"
          @change="handle_all_controller()"
          type="text"
          class="bg-grey appearance-none order-2-2 order-2-grey-lighter rounded w-full py-2 px-4 text-grey-darker leading-tight focus:outline-none focus:bg-white focus:order-2-purple"
          :placeholder="'all'"
          :id="'all_'"
        />
  <template v-for="(column, index2) in int_grid_columns()">
        <input
          v-model="form['column'+column]"
          :name="'columncontroller' + column"
          :key="'columncontroller'+index2"
          style="width:100px;"
          @change="handle_column_controller(column)"
          type="text"
          class="bg-grey-light appearance-none order-2-2 order-2-grey-lighter rounded w-full py-2 px-4 text-grey-darker leading-tight focus:outline-none focus:bg-white focus:order-2-purple"
          :placeholder="'col ' + column"
          :id="'column_' + column"
        />
  </template>
    <input type="number" 
    style="width:100px;"
    placeholder="rows"
    class="bg-yellow-lighter appearance-none order-2-2 order-2-grey-lighter rounded w-full py-2 px-4 text-grey-darker leading-tight focus:outline-none focus:bg-white focus:border-purple"
    v-model="grid_columns" />
  <br />
    <template v-for="(row, index) in int_grid_rows()">
      <input
          v-model="form['row'+row]"
          :name="'rowcontroller' + row"
          :key="'rowcontroller'+index"
          style="width:100px;"
          @change="handle_row_controller(row)"
          type="text"
          class="bg-grey-light appearance-none border-2 border-grey-lighter rounded w-full py-2 px-4 text-grey-darker leading-tight focus:outline-none focus:bg-white focus:border-purple"
          value="row"
          :placeholder="'row ' + row"
          :id="'row_' + row"
        />
      <template v-for="(column, index2) in int_grid_columns()">
        <input
          v-model="created_grid['col'+column+'row'+row]"
          :name="'el' + row + '_' + column"
          :key="index+'-'+index2"
          style="width:100px;"
          @change="handle_cell_controller()"
          type="text"
          class="bg-grey-lighter appearance-none border-2 border-grey-lighter rounded w-full py-2 px-4 text-grey-darker leading-tight focus:outline-none focus:bg-white focus:border-purple"
          value="main"
          :placeholder="column + ' - ' + row"
          :id="column + '_' + row"
        />
      </template>
      <input :key="index" style="width:100px;" disabled class="bg-white w-full py-2 px-4 text-white"/>
      <br />
    </template> 
    
  <input type="number" 
    style="width:100px;"
    placeholder="rows"
    class="bg-yellow-lighter appearance-none border-2 border-grey-lighter rounded w-full py-2 px-4 text-grey-darker leading-tight focus:outline-none focus:bg-white focus:border-purple"
    v-model="grid_rows" />
    
    <template v-for="(column2, index3) in int_grid_columns()">
         <input :key="'dymmu'+index3" style="width:100px;" disabled class="bg-white w-full py-2 px-4 text-white"/>
      
        </template><input style="width:100px;" disabled class="bg-white w-full py-2 px-4 text-white"/>

    <br /><br />    <br>
    <template v-if='this.grids.all.unique_areas.length > 1'>
     <br><h3>Available grids, based on defined classes:</h3> <div class="buttons"><br>
      <button class="button bg-green-lighter border-2 border-grey-lighter py-2 px-6 hover:bg-blue selected:border-red" 
      :disabled="active_area == 'all'"
      @click="enable_area('all')" 
      >all</button> - 
    <template v-for="(area, index) in areas">
      <button class="button bg-blue-lighter border-2 border-grey-lighter py-2 px-6 hover:bg-blue hover:border-red" 
      :disabled="active_area == area"
      @click="enable_area(area)" 
      :key="index" >{{area}}</button> - 
    </template>
    </div><br>
    </template>

    <!-- <template v-if="active_area == 'all'"> -->
      <div :class="'wrapper' + set_active_area('all')" :style=" 'margin: 10px; grid-template-areas: ' + grid_template_areas +';grid-template-columns: '+ this.grids.all.columns+';'" >
      <template v-for="(area, index) in areas">
        <template v-if="is_subarea(area)">
          <div 
          :class="area + ' wrapper-part subgrid ' +set_active_area(area)" 
          :key="index"
          @click="enable_area(area)"
          :style="'grid-area: '+area+'; grid-template-areas: '+subgrids_message[area]+'; '+define_background_color(area)+';'"
          >
          <!-- <template v-if="Object.keys(grids[area].unique_areas.length).length > 1"> -->
            <template v-if="grids[area].unique_areas.length > 1">
              <template v-for="(subarea, index2) in grids[area].unique_areas">
                <div :key="index2" 
                @click="enable_area(subarea)"
                :class="subarea + ' wrapper-part-deep'" 
                :style="'grid-area: '+subarea" >
                  <p>{{subarea}} :{{ class_contents[subarea] }}</p>
                </div>
                
              </template>
            </template>
          </div>
        </template>
        <template v-else>
          <div 
          :key="index" 

          :class="area + ' wrapper-part'" 
          :style="'grid-area: '+area" >{{ area }}
            <p>{{area}} : {{ class_contents[area] }}</p>
          </div>
        </template>
      </template>
      </div>

      <input
      type="text"
      style="width:200px;"
      placeholder="class"
      class="bg-grey-lighter appearance-none border-2 border-grey-lighter rounded w-full py-2 px-4 text-grey-darker leading-tight focus:outline-none focus:bg-white focus:border-purple"
      v-model="user_class"
    /> 
      <input
      type="text"
      style="width:200px;"
      placeholder="input"
      class="bg-grey-lighter appearance-none border-2 border-grey-lighter rounded w-full py-2 px-4 text-grey-darker leading-tight focus:outline-none focus:bg-white focus:border-purple"
      @change="fill_class_content()"
      v-model="user_content"
    /> 

  </div>
</template>

<script>
let grid = [
  {id: 1, x: 1, y:1, name: "top"},
  {id: 2, x: 1, y:2, name: "top"},
  {id: 3, x: 1, y:3, name: "top"},
  {id: 4, x: 2, y:1, name: "side"},
  {id: 5, x: 2, y:2, name: "main"},
  {id: 6, x: 2, y:3, name: "main"},
  {id: 7, x: 3, y:1, name: "side"},
  {id: 8, x: 3, y:2, name: "main"},
  {id: 9, x: 3, y:3, name: "main"},
];

export default {
  name: "HelloWorld",
  data() {
    return {
      user_class: "",
      user_content: "",
      areas: ["all"],
      //all_areas: ["all"],
      sub_areas: [1],
      //calculating_areas: [],
      grid_columns: 4,
      grid_rows: 4,
      created_grid: {},
      whole_grid: {},
      form: {
        parent_id: []
      },
      standard_grid: {
        columns: 4, 
        rows: 4, 
        grid: {},
        unique_areas: ["sub"]
        },
      grids: {
        all: {columns: 4, rows: 4, grid: {}, unique_areas: ["main"]}
      },
      class_contents: {awd: "hi there"},
      active_area: 'all',
      grid_template_columns: 8,
      //grid: grid,
      el1_1: 15,
      msg: "Welcome to Your Vue.js App",
      subgrids_message: {},
      grid_template_areas:
        "'hd hd hd hd   hd   hd   hd   hd   hd' 'sd sd sd main main main main main main' 'sd sd sd main main main main main main' 'sd sd sd main main main main main main' 'ft ft ft ft   ft   ft   ft   ft   ft'"
    };
  },

  mounted: function() {
    //this.loop_over_inputs();
  },

  computed: {
    wrapper_style: function(area) {
      return 'grid-area: '+area+'; grid-template-areas: '+this.subgrids_message[area]+'; background-color: lightgreen;';
    },

    get_grid_template_columns: function() {
      var line = '';
      for (var i = 1; i <= this.grid_columns; i++) {
        line = line + '1fr ';
      }
      return line;
    },

    is_every_area_filled: function() {
      for (let area of this.grids.all.unique_areas) {
        if (this.grids[area] == undefined) {
          console.log("yes, area "+area+" is undefined")
          return false;
        }
        if (this.object_is_empty(this.grids[area].grid)) {
          console.log("yes, area "+area+" is empty")
          return false;
        }
      }

      return true;
    },

    user_instruction: function() {
      // if (Object.keys(this.grids.all.grid).length === 0 && this.grids.all.grid.constructor === Object) {
      if (this.object_is_empty(this.grids.all.grid)) {
        return "First, define a main grid: set size and classes: \r\n You can adjust the size with the yellow buttons.";
      } else if (this.grids.all.unique_areas.length == 1) {
        return "Nice, you have 1 area, do you want more?";
      } else if (!this.is_every_area_filled) {
        return "Excellent! Now we can start working on subgrids, use the blue buttons!";
      } else {
        return "You`ve set every subgrid, you can continue tweaking or have a look at some options"
      }
    }
  },

   watch: {
      value(created_grid) {
          this.$el.innerHTML = v;
      },
  },

  methods: {
    define_background_color(area) {
      if (area == this.active_area || this.active_area == 'all') {
          return 'background-color: rgb(211, 230, 240;';
        } else {
          return 'background-color: rgb(224, 240, 250)';
      }
    },

    set_active_area(area) {
      if (area == this.active_area) {
        return ' shadow-xl';
        } else {
          return ''
        return '';
      }
    },

    object_is_empty(given_object) {
      return Object.keys(given_object).length === 0 && given_object.constructor === Object;
    },

    fill_class_content() {
      this.class_contents[this.user_class] = this.user_content;
    },

    redefine_areas() {
      this.grids[this.active_area].unique_areas = [...new Set(Object.values(this.created_grid))];

     //for (let area of this.grids.all.unique_areas) {
     //  if (!this.grids[area]) {
     //    this.enable_area(area)
     //    console.log(area);
     //    console.log(typeof(this.grids[area]));
     //  }
     //  //standard_grid
     //}
     //this.enable_area('all');
    },
    
    handle_cell_controller() {
      this.rebuild_grid();
    },

    handle_row_controller(row) {
      var grid_columns = this.int_grid_columns();

      for (var column = 1; column <= grid_columns; column++) {
        this.created_grid["col"+column+"row"+row] = this.form["row"+row];
      }

      this.rebuild_grid();

      this.form["row"+row] = '';
    },
    
    /* Sets every column to the given value */
    handle_column_controller(given_column) {
      var grid_rows = this.int_grid_rows();

      for (var row = 1; row <= grid_rows; row++) {
          this.created_grid["col"+given_column+"row"+row] = this.form["column"+given_column];
      }

      this.rebuild_grid();

      this.form["column"+given_column] = '';
    },

    rebuild_grid() {
      this.save_current_area();
      this.redefine_areas();
      this.build_main_grid();
    },

    handle_all_controller() {
      var grid_columns = this.int_grid_columns();
      var grid_rows = this.int_grid_rows();

      for (var column = 1; column <= grid_columns; column++) {
        for (var row = 1; row <= grid_rows; row++) {
          this.created_grid["col"+column+"row"+row] = this.form["all"];
        }
      }

      this.rebuild_grid();

      this.form["all"] = '';
    },

    define_main_grid_areas() {
       this.build_main_grid();
    },

    save_current_area() {
      this.grids[this.active_area] =  {
        grid: this.created_grid,
        columns: this.int_grid_columns(),
        rows: this.int_grid_rows(),
        unique_areas: [...new Set(Object.values(this.created_grid))],
      };

      this.areas = this.grids[this.active_area].unique_areas;
    },

    create_grid_or_load_grid(area_name) {
      if (this.grids[area_name] != undefined) {
        this.created_grid = this.grids[area_name].grid;
        this.grid_columns = this.grids[area_name].columns;
        this.grid_rows = this.grids[area_name].rows;

      //else lets create a new one!
      } else {
        this.created_grid = {};
        this.grid_columns = 4;
        this.grid_rows = 4;
      }
    },

    enable_area(area_name) {
      //save the current grid:
      this.save_current_area();

      //reset
      this.created_grid = {};
    
      //if it is saved before, reload it
      this.create_grid_or_load_grid(area_name);

      //finally, set the active area
      this.active_area = area_name;
      this.rebuild_grid();
    },

    int_grid_columns: function() {
      return parseInt(this.grid_columns);
    },

  
    int_grid_rows: function() {
      return parseInt(this.grid_rows);
    },

    is_subarea: function(area) {
      return this.sub_areas.includes(area);
    },

    build_main_grid : function() {
      if (this.grids.all == undefined) {
        this.enable_area('all')
      }

      //first, show the main grid:
      let columns = this.grids.all.columns;
      let rows = this.grids.all.rows;

      let current_grid = this.grids.all.grid;
      let message = '';
      let line = "";
      let areas = [];

      for (var row = 1; row <= rows; row++) {
        line = "";
        for (var column = 1; column <= columns; column++) {
          areas.push(this.grids.all.grid["col"+column+"row"+row]);
          line =
            line +
            this.grids.all.grid["col"+column+"row"+row] +
            " ";
          // console.log(line);
        }

        message = message + "'" + line + "' ";
      }
      this.grids.all.grid_template_areas = message;
      let distinctAreas = [...new Set(areas)];
      this.areas = distinctAreas;
      this.all_areas = distinctAreas;

      for (let area of distinctAreas) {
        if (this.grids[area] != undefined) {
          this.sub_areas.push(area);
          this.subgrids_message[area] = this.create_sub_grid(area); 
        }
      }

      this.msg = message;
      this.grid_template_areas = message;

    },

    create_sub_grid: function(name) {

      let columns = this.grids[name].columns;
      let rows = this.grids[name].rows;
      let message = '';
      let line = "";
      let areas = [];

      for (var row = 1; row <= rows; row++) {
        line = "";
        for (var column = 1; column <= columns; column++) {
          areas.push(this.grids[name].grid["col"+column+"row"+row]);
          line =
            line +
            this.grids[name].grid["col"+column+"row"+row] +
            " ";
          
        }

        message = message + "'" + line + "' ";
      }

      return message;
    },

    loop_over_inputs: function() {
      var grid_columns = this.int_grid_columns();
      var grid_rows = this.int_grid_rows();

      let areas = [];
      let message = "";
      let line = "";
      for (var i = 1; i <= grid_rows; i++) {
        line = "";
        for (var j = 1; j <= grid_columns; j++) {
          areas.push(document.getElementsByName("el" + i + "_" + j)[0].value);
          line =
            line +
            document.getElementsByName("el" + i + "_" + j)[0].value +
            " ";
        }

        message = message + "'" + line + "' ";
      }

      //set which areas are clickable, 
      if (this.active_area == 'all') {
        let distinctAreas = [...new Set(areas)];
        this.areas = distinctAreas;
      }
    
      this.msg = message;

      this.grid_template_areas = message;
      //this.grid_template_columns = grid_columns;
      
    }
  }
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
h1,
h2 {
  font-weight: normal;
}
ul {
  list-style-type: none;
  padding: 0;
}
li {
  display: inline-block;
  margin: 0 10px;
}
a {
  color: #42b983;
}
.wrapper {
  display: grid;
  grid-auto-rows: minmax(50px, auto);
  grid-gap: 10px;
}

.subgrid {
  display: grid;
  grid-auto-rows: minmax(50px, auto);
  grid-gap: 5px;
  background-color: lightgreen;
}

.wrapper-part {
  background-color: rgb(224, 240, 250);
  
}

.wrapper-part-deep {
  background-color: rgb(175, 205, 212);
}

.header {
  grid-area: hd;
}

.footer {
  grid-area: ft;
}
.content {
  grid-area: main;
}
.sidebar {
  grid-area: sd;
}

.h {
  grid-area: h;
}
.m {
  grid-area: m;
}
.f {
  grid-area: f;
}
.s {
  grid-area: s;
}

</style>