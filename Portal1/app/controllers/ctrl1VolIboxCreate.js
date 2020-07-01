module1.controller('ctrl1VolIboxCreate', function($scope) {

    $scope.vol_Function = function (vol_Form) {

        $scope.vol_name         = vol_Form.vol_name.toLowerCase();
        $scope.vol_size         = vol_Form.vol_size;
        $scope.unit             = vol_Form.unit.value;
        $scope.metaValue        = vol_Form.options_os_type.value;
        $scope.lun_size         = vol_Form.lun_size;
        $scope.clusterName      = vol_Form.clusterName;
        $scope.LunId            = vol_Form.LunId;


        var all = "vol.create name="+ $scope.vol_name + " size=" + $scope.vol_size+$scope.unit + " thin=yes " + "pool=pool1" + "\n";
        all += "metadata.set object=" + $scope.vol_name + " objtype=vol " + "key=filesystem_type " + "value=" + $scope.metaValue + "\n";
        all += "vol.map name=" + $scope.vol_name + " cluster=" + $scope.clusterName + " lun=" + $scope.LunId + "\n";

        $scope.all = all;

    };



    $scope.options_os_type = [

        { name: 'VMware', value: 'VMFS' },
        { name: 'Linux', value: 'EXT3' },
        { name: 'Windows', value: 'NTFS' }

    ];



    $scope.unit_options = [

        {name: 'GiB', value: 'GiB' }, { name: 'TiB', value: 'TiB'}

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
