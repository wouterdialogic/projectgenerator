<template>
  <div class="QuestionShowComponent z-0 shadow-lg m-4 p-4 bg-grey-lightest" :class="classes"> 
    <div>
        <div class="w-full max-w-md bg-grey-light m-2 p-2 m-auto flex justify-between">
            <div class="w-3/4 m-2 p-2 ">{{title_question}}</div>
            <div class="flex">
                <!-- https://icons8.com/icon/set/finger/windows -->
                <div class="m-1 p-1 h-auto"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAFCSURBVFhH7ZQ9SgUxFEZHtBB3IC7AXdhaWWgvCGJtYWHrDxZ2FtZuwB1Y2KiF4A5sBLFR/MFOLPR81wmEMPMShyTVHDi8ufPmJt8dhjQjIwOZwXt8xT2cxqps4I/nPlbDTa+Nz9rfJ6yGm14hFMa9hSr40yvIfHv9jFUIp19r6wssTji9OEHVu1YVJpxe3KHuLVuVCS04STe9+MSuZ0Lf8AiTzouuBXzd9LPY9f8kDzCKezik734KS6jeF6silAiwgOr9sCpCiQArqN5LqyKUCHCI6j22KkKJADqo1LtqVYTcAabwHdWroztK7gCLqL5HqxLIHWAd1XduVQK5A5yi+nasSsDf6Aav/y4HB7hF9ekwSsLf6KpVDAmg4/oLv3FON1Lo2+i/AfT1b6F69BaScRvldBOT6VpgqA+4jSMjPTTNL20vvSqVQVUIAAAAAElFTkSuQmCC"></div>
                <div class="m-1 p-1 h-auto"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAFMSURBVFhH7dS/K0VhHMfxIwYZXD/jIoOSf8Egq8ngD7BdJmXwJ2CwWwwWq9FmsEp+DhIlA5OEMMnA+/M4T0mnnO99nnNLnU+96n6/ne/zfDv3dpMyZcrkyCJu8RmBOTVkHVQvcw6gwTk0qZEzvy+sa4E2fOAdrWoYEmWBSWhIb8GaKAssQUPrrrIlygLb0NCsq2yJssAdNDTmKluCF6hCA8+w/Pp9gheYgQZ2XWVP8AJr0MCyq+wJXmAPGph2lT3BC7xAA4Ousid4gSdoYMJV9gQvsAI/9Jdx/Ewvsp6T3GnGKh6RdZD3ihb49OEcWc9KtMxDB+646jv9uID6Z9CbKCSjeIMuWlCDDOAS6p2iB4VlC7poE/qXHMJV2jtBNwrNPXTZCIZxndbH6ELh8a9/Cjfp5yN0oiHxX4F3iA40LO3YwAP2UUGZ/5ok+QI0fK8jKmL+nwAAAABJRU5ErkJggg=="></div>
                <!-- <div class="m-1 p-1 bg-red-light h-auto"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAFJSURBVFhH7Ze9SgNBFEbXRguxMpXPIGIpYhNfwMcQO1srsVEQBTstLdMJ8S0CwSew9AdEFCtFRM837IVlycrOzO6sSA4ckjtw73zZzATNpkypySwe413uUb6WDG34XfIQk3GP2nQN1/P3ehLJsE9tlOvW+bMBHvAZT7DVQ1kVoOgIn7CVQLaJYXXxUJa1QI1cWxtqVNW/BYq6tjbEqFs3dm2rNjB8a29iB0T1z2OnAQbYWYBdtObkAVbwAzsLcIVqOs9fkwd4RDUtuSqOoAD6TVdTz1VxBAW4RjWduSqcBdScN1d5sIqfqOZtLQTSR824cZUnO6hm3YZNLQQwRM3Yd1UA9gfpK25owYM9tN5FLYQwg5doT+IUl3EOJ6HvXE/LztAXbmEUCqH/CzRMQ+v6gtGbF9HBvMBbfMdJm+q0j/EAm7jC/5os+wFQ36kTd620xgAAAABJRU5ErkJggg=="></div> -->
                <div class="m-1 p-1 h-auto"><img class="bg-red" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAGJSURBVFhH7dQ/SFVhHMbxayJEiDQKQZBTg6OD4JRrq0NbrW7tQqPN7k6Cozi3NDgFbbo1CIHQ0BQiSVD5fK7ngt7OPfeP59ybcL/whff8/jzve0FsTbnvLBdOjI+FE2Ej/i10HisP42nsPMBZbWxsRRefFDqrjYUn8Ty6dL3QWU2vcfaiCw/bX9c4q+k1ymr8Ey/jkkKBs5qemUaYiZ+iX/peoQs1PTNma+d1dMG3uKDQhZqeGbO1Mh/PovA3Cj3QM2PWTm1sR8Gf4wOFAjV20DOjZqcWnsWf0R/YmsINuh8AM2bt2L0zB9El++2v25Q9AGbV7d6JF1HQRXyq0EWvB5i1oydjJGbjcRTyTqGEXg+AHT0ZsoZmMwr4Gh8plFD1ADt29WUNxeP4PVp+pTAidmXIkjkwO9HiUaz6r2aGvbArw4zMgXgef8XfcUWhgn4PgAxZMmX35UMUutv+qgdZMmVX8jIa/BEXFWpClkzZ7ihlLn6JhprUHe76h7exbKEJ3TVlyv9Aq3UFsuGgEapZHnUAAAAASUVORK5CYII=">
                </div>
            </div>
        </div>

        <p class="w-full max-w-md bg-grey-light m-2 p-2 m-auto ">{{leftColStyles}}</p>
        <p class="w-full max-w-md m-4 p-4 m-auto "></p>
        
        <div v-for="field in fields" :key="field.id">
        <p class="w-full max-w-md bg-grey-lighter m-2 p-2 m-auto ">{{field.label}}</p>
        <template v-if="active_textfield_id == field.id">
        
        <div class="columns" >
            <div class="container2  justify-center " style="min-height: 100px" :style="leftColStyles">
                <div class="column2 w-full ">
                    <textarea 
                    :ref="'textarea'+field.id"
                    @blur="active_textfield_id = false"
                    class="z-150 border border-blue-lighter text-center p-2 m-2 h-full w-full max-w-md m-auto" 
                    v-model="field.content">
                    </textarea>  
                </div>
            </div>
        </div>
        </template>
        <template v-else>
           
        <div @click="set_active_text_edit_element(field.id)" 
            :ref="'text_div'+field.id"
            class="w-full max-w-md bg-white m-2 p-2 m-auto" 
            v-html="field.content">
            {{field.content}}
        </div>
        </template>
        <p class="w-full max-w-md m-4 p-4 m-auto "></p>
      </div>
    </div>
  </div>
</template>

<script>

export default {
    name: "QuestionShowComponent",
    props: {
        question: String,
        classes: String,
    },
    data: function() {
        return {
            leftColStyles: { },
            lines: ['one', 'two','three'],
            title_question: "doe you liek monkees? doe you liek monkees?doe you liek monkees?doe you liek monkees?doe you liek monkees?doe you liek monkees?doe you liek monkees?doe you liek monkees?doe you liek monkees?doe you liek monkees?doe you liek monkees?",
            active_textfield_id: '',
            fields: [
                {"id": 1, "label": "question", "content": "this is ok?"},
                {"id": 2, "label": "question_details", "content": "this isdaw da dwad wad awd this isdaw da dwadthis isdaw da dwad wad awd this isdaw da dwad wad awd this isdaw da dwad wad awd this isdaw da dwad wad awd this isdaw da dwad wad awd this isdaw da dwad wad awd  wad awd this isdaw da dwad wad ahis isdaw da dwad wad awd this isdaw da dwadthis isdaw da dwad wad awd this isdaw da dwad wad awd this isdaw da dwad wad awd this isdaw da dwad wad awd this isdaw da dwad wad awd this isdaw da dwad wadhis isdaw da dwad wad awd this isdaw da dwadthis isdaw da dwad wad awd this isdaw da dwad wad awd this isdaw da dwad wad awd this isdaw da dwad wad awd this isdaw da dwad wad awd this isdaw da dwad wad awd  wad awd this isdaw da dwad wad ahis isdaw da dwad wad awd this isdaw da dwadthis isdaw da dwad wad awd this isdaw da dwad wad awd this isdaw da dwad wad awd this isdaw da dwad wad awd this isdaw da dwad wad awd this isdaw da dwad wad awd  wad awd this isdaw da dwad wad ahis isdaw da dwad wad awd this isdaw da dwadthis isdaw da dwad wad awd this isdaw da dwad wad awd this isdaw da dwad wad awd this isdaw da dwad wad awd this isdaw da dwad wad awd this isdaw da dwad wad awd  wad awd this isdaw da dwad wad a awd  wad awd this isdaw da dwad wad ahis isdaw da dwad wad awd this isdaw da dwadthis isdaw da dwad wad awd this isdaw da dwad wad awd this isdaw da dwad wad awd this isdaw da dwad wad awd this isdaw da dwad wad awd this isdaw da dwad wad awd  wad awd this isdaw da dwad wad ahis isdaw da dwad wad awd this isdaw da dwadthis isdaw da dwad wad awd this isdaw da dwad wad awd this isdaw da dwad wad awd this isdaw da dwad wad awd this isdaw da dwad wad awd this isdaw da dwad wad awd  wad awd this isdaw da dwad wad awd awd ok"},
                {"id": 3, "label": "answer", "content": "this isdaw da dwad wad awd awd ok"},
            ],
        };
    },
    methods: {
        set_active_text_edit_element(id) {
            console.log(this.$refs);
            console.log(this.$refs["text_div"+id][0].clientHeight);
            var heightString = this.$refs["text_div"+id][0].clientHeight + 'px';
            console.log(heightString)
            this.leftColStyles = {'height': heightString};
            // Vue.set(this.leftColStyles, 'height', heightString); 
            this.active_textfield_id = id;
            this.$refs["text_div"+id][0].focus();
          
        },
    },
    mounted () {
       
    },

};
</script>

<style>
/* .columns{width:300px} */
/* .left-column {float:left; width:200px; border:solid 1px black} */
/* .right-column {float:right; border:solid 1px blue; } */
.container2 {
   display: flex;
}
.column2 {
   /* border: 1px solid; */
   /* padding: 20px; */
   /* width: 150px; */
}
</style>
