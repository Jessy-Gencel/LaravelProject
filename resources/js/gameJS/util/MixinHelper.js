function combineMethods(instance, updateMethods = [], dieMethods = []) {
    instance.combinedUpdate = function (time, delta) {
        updateMethods.forEach(method => {
            if (typeof instance[method] === 'function') {
                instance[method](time, delta); 
            }
        });
        if (typeof instance.update === 'function') {
            instance.baseUpdate(time, delta);
        }
    };

    instance.combinedDie = function (awardScore = true) {
        dieMethods.forEach(method => {
            if (typeof instance[method] === 'function') {
                instance[method](); 
            } else {
            }
        });
        if (typeof instance.die === 'function') {
            instance.baseDie(awardScore);
        }
    };

    instance.update = instance.combinedUpdate;
    instance.die = instance.combinedDie;
}
export { combineMethods };