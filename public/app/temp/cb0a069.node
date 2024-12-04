class Job{
    constructor(start,end,cpuLoad){
        this.start = start;
        this.end = end;
        this.cpuLoad = cpuLoad;
    }
};
Class MaximumCPULoad
{
    static findMaxCPULoad(jobs)
    {
        //sort the jobs by start time
        jobs.sort((a,b)=>a.start - b.start);
        let maxCPULoad = 0;
        let currentCPULoad = 0;
        const minHeap = [];
        for(const job of jobs){
            //remove all jobs that have ended
            while(minHeap.length > 0 && job.start > minHeap[0].end){
                currentCPULoad -= minHeap.shift().cpuLoad;
            }
            //add the current job into the minHeap
            minHeap.push(job);
            currentCPULoad += job.cpuLoad;
            maxCPULoad = Math.max(maxCPULoad,currentCPULoad);
        }
        return maxCPULoad;
    }
}

const input = [new Job(1,4,5),new Job(2,5,4),new Job(7,9,6)];
console.log("Maximum CPU Load at any time: " + MaximumCPULoad.findMaxCPULoad(input));