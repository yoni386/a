#!/usr/bin/perl


use strict;
use warnings;


use lib "/sc_v2/perl_netapp/lib/perl/NetApp";
use NaServer;
use Pod::Usage;

use POSIX qw(strftime);


use CGI qw(:standard);
my $c = CGI->new;
my $ds = $c->param('params_vm_ds_input');
#our $vol = 'v_'.$ds;
my $vol;
use JSON;



SWITCH: {
  $ds eq "ds_customers1_2008_lun1" && do { $vol = "v_ds_lun1"; last SWITCH; };
  $ds eq "ds_customers1_2008_lun2" && do { $vol = "v_ds_lun2"; last SWITCH; };
  $ds eq "ds_customers1_2003_lun3" && do { $vol = "v_ds_lun3"; last SWITCH; };
  $ds eq "ds_customers1_lin_lun4"  && do { $vol = "v_ds_lun4" ; last SWITCH; };
}


our $filer = "ip";
our $user_netapp = "root";
our $password_netapp = "pass!";

our $s = NaServer->new($filer, 1, 1);
$s->set_admin_user($user_netapp, $password_netapp);


my @array;
print header('application/json');


                    my $output = $s->invoke("snapshot-list-info", "volume", $vol);
#
                        if ($output->results_errno != 0) {
                                		my $r = $output->results_reason();
                                		print "snapshot-list-info failed: $r\n";
                                	}

                        my $snapshotlist = $output->child_get("snapshots");
                            if (!defined($snapshotlist) || ($snapshotlist eq "")) {
                                            		# no snapshots to report
                                printf("No snapshots on volume %s \n\n", $vol);
                                      exit(0);
                                            	}


                                my @snapshots = $snapshotlist->children_get();
                                	foreach my $ss (@snapshots) {

                                		my $accesstime = $ss->child_get_int("access-time", 0);
                                		my $total =		 $ss->child_get_int("total", 0);
                                		my $cumtotal =   $ss->child_get_int("cumulative-total", 0);

                                		my $busy = ($ss->child_get_string("busy") eq "true");

                                		my $dependency = $ss->child_get_string("dependency");
                                		my $snap_name = $ss->child_get_string("name");

                                		my $snap_date = localtime($accesstime);



                                		my $snap_date_time = strftime("%d-%m-%y %H:%M", localtime($accesstime));


        push @array, { "vol_name"=> $vol, "snap_name" => $snap_name, "snap_date" => $snap_date_time };


                                   }



  print JSON::PP->new->utf8->encode(\@array);

