const tasks = new Set();
let pending = false;
function frame(now) {
    for (const task of [...tasks]) if (task(now) === false) tasks.delete(task);
    pending = tasks.size > 0;
    if (pending) requestAnimationFrame(frame);
}
export function scheduleFrame(task) {
    tasks.add(task);
    if (!pending) { pending = true; requestAnimationFrame(frame); }
}
