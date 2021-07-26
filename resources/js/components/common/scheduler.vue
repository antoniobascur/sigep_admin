<template>
    <kendo-scheduler :data-source="localDataSource"
                     :date="date"
                     :height="500"
                     :resources="resources"
                     @change="onChange"
                   >
<!--        <kendo-scheduler-view :type="'day'"></kendo-scheduler-view>-->
        <kendo-scheduler-view :type="'workWeek'" :selected="true" :showWorkHours="true"></kendo-scheduler-view>
<!--        <kendo-scheduler-view :type="'week'"></kendo-scheduler-view>-->
<!--        <kendo-scheduler-view :type="'month'"></kendo-scheduler-view>-->
        <kendo-scheduler-view :type="'agenda'"></kendo-scheduler-view>
    </kendo-scheduler>
</template>

<script>
import { Scheduler, SchedulerView } from '@progress/kendo-scheduler-vue-wrapper';

export default {
    components: {
        Scheduler,
        SchedulerView
    },
    data: function () {
        return {
            date: new Date(),
            startTime: new Date("2021/7/26 08:00 AM"),
            endTime:new Date("2021/6/13 22:00 PM"),
            workDayStart: new Date("2021/7/26 08:00 AM"),
            workDayEnd: new Date("2021/7/26 20:00 PM"),
            localDataSource: [
                {
                    id: 1,
                    start: new Date("2021/7/26 11:00 AM"),
                    end: new Date("2021/7/26 1:00 PM"),
                    title: "Practica 1",
                    roomId: 1 // The unique identifier of the first room (Meeting Room 101)
                },
                {
                    id: 2,
                    start: new Date("2021/7/26 10:15 AM"),
                    end: new Date("2021/7/26 12:30 PM"),
                    title: "Practica 2",
                    roomId: 2 // The unique identifier of the second room (Meeting Room 102)
                }
            ],
            resources: [
                {
                    field: "roomId", // The field of the Scheduler event which contains the resource identifier.
                    title: "Room", // The label displayed in the Scheduler edit form for this resource.
                    dataSource: [
                        {
                            text: "Meeting Room 101", // Text of the resource instance
                            value: 1, // The identifier of the resource instance. Use that value to assign an event to this instance.
                            color: "#1c9ec4" // Used as the background of events assigned to this resource.
                        },
                        {
                            text: "Meeting Room 102",
                            value: 2,
                            color: "#ff7663"
                        }
                    ]
                }]
        }},
    computed: {

    },
    methods: {
        onChange: function (ev) {
            console.log("Event :: change");
            console.log(ev);
            console.log(this.localDataSource);
            console.log(this.resources);
        },
    }
}
</script>

<style scoped>

</style>
