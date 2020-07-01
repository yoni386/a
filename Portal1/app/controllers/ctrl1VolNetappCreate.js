module1.controller('ctrl1VolNetappCreate', function($scope) {


    $scope.vol_Function = function (vol_Form) {

        $scope.vol_name       = vol_Form.vol_name;
        $scope.vol_size       = vol_Form.vol_size;
        $scope.unit           = vol_Form.unit.value;
        $scope.qtree_path     = vol_Form.vol_name.replace('v', 'q');
        $scope.qtree_security = vol_Form.os_qtree_security_options.qtree_security;
        $scope.increment_size = vol_Form.increment_size;
        $scope.max_size       = $scope.vol_size * 1.5;
        $scope.vol_thin_size  = "1";
        $scope.lun_size       = vol_Form.lun_size;
        $scope.lun_path       = "/vol/"+$scope.vol_name+"/"+$scope.qtree_path+"/"+$scope.vol_name+".lun";
        $scope.igroup_name    = vol_Form.igroup_name;
        $scope.lun_id         = vol_Form.lun_id;




        var all = "vol create "+ $scope.vol_name + " aggr0 " + $scope.vol_size+$scope.unit+"\n";
        all += "sis on /vol/"+ $scope.vol_name +"\n";
        all += "qtree create /vol/"+ $scope.vol_name+"/"+$scope.qtree_path+"\n";
        all += "qtree security /vol/"+ $scope.vol_name + " " + $scope.qtree_security+"\n";
        all += "qtree security /vol/"+ $scope.vol_name +"/"+ $scope.qtree_path+ " " + $scope.qtree_security+"\n";
        all += "vol options " + $scope.vol_name +" fs_size_fixed off"+"\n";
        all += "vol autosize " + $scope.vol_name + " on"+"\n";
        all += "vol options " + $scope.vol_name + " try_first volume_grow"+"\n";
        all += "vol options " + $scope.vol_name + " fractional_reserve 0"+"\n";
        all += "vol options " + $scope.vol_name + " nosnap on"+"\n";
        all += "snap autodelete " + $scope.vol_name + " on"+"\n";
        all += "snap autodelete " + $scope.vol_name + " target_free_space 10"+"\n";
        all += "snap reserve -V " + $scope.vol_name + " 0"+"\n";
        all += "vol size " + $scope.vol_name + " " + $scope.vol_thin_size+"g"+"\n";
        all += "vol autosize " + $scope.vol_name + " " +"-i " + $scope.increment_size+"g"+" -m " + $scope.max_size+$scope.unit+"\n";
        all += "snap sched " + $scope.vol_name + " 0"+"\n";
        all += "lun create -s " + $scope.lun_size + $scope.unit +" -t " + vol_Form.os_qtree_security_options.os + " -o noreserve " + $scope.lun_path+"\n";
        all += "lun map " + $scope.lun_path + " " +  $scope.igroup_name + " " + $scope.lun_id + "\n";


        $scope.all = all.toLowerCase();


    };

    $scope.vol_size_max_Function = function (vol_size) {
        $scope.max_size = vol_size * 1.5;

    };



    $scope.os_qtree_security_options = [

        { name: 'VMware', qtree_security: 'unix', os: 'vmware' },
        { name: 'Linux', qtree_security: 'unix', os: 'linux' },
        { name: 'Windows', qtree_security: 'ntfs', os: 'windows_2008'}

    ];



    $scope.unit_options = [

        {name: 'GB', value: 'g' }, { name: 'TB', value: 't'}

    ];




    $scope.complete = function(e) {
        console.log('copy complete', e);
        $scope.copied = true
    };
    $scope.$watch('input', function(v) {
        $scope.copied = false
    });
    $scope.clipError = function(e) {
        console.log('Error: ' + e.name + ' - ' + e.message);
    };

});
