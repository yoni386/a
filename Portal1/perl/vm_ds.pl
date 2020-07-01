#!/usr/bin/perl


use strict;
use warnings;

use VMware::VIRuntime;

use warnings;


use Pod::Usage;

use POSIX qw(strftime);


use CGI qw(:standard);
use JSON;


my $url = "https://172.17.16.4/sdk";
my $username_vmware = "sa-portal-int1";
my $password_vmware = 't$2lsim';

Util::connect($url, $username_vmware, $password_vmware);


my $cluster = "Customers1";
my $cluster_view = Vim::find_entity_view(view_type => 'ClusterComputeResource', filter => {'name' => $cluster});
my $vm_views = Vim::find_entity_views(view_type => 'VirtualMachine', begin_entity => $cluster_view,

properties => ['name', 'datastore']) ||
    die "Failed to get VirtualMachines: $!";


my $datastore_views = Vim::find_entity_views(view_type => "Datastore",
            properties => ['name']) ||
  die "Failed to get Datastores: $!";


my %ds_map = map { $_->get_property('mo_ref.value') => $_ } @{ $datastore_views || [] };



my @array;
print header('application/json');


foreach my $vm ( @{$vm_views || []} ) {


        my @ds_refs = map($_->{'value'}, @{$vm->get_property('datastore') || []});

        my @datastores = @ds_map{@ds_refs};


        push @array, { "vm_name" => $vm->get_property('name'), "vm_ds" => $datastores[0]->{name}};



}


  print JSON::PP->new->utf8->encode(\@array);
