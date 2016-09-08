    <!-- Body starts -->
    <div class="row dash-row">
        <div class="col l3 m6 s12">
            <div class="card red darken-1">
                <div class="card-content white-text text-center">
                    <i class="large material-icons block">people</i>
                    <span class="card-title"><?php echo $usercount;?> Users</span>
                </div>
            </div>
        </div>

        <div class="col l3 m6 s12">
            <div class="card red darken-1">
                <div class="card-content white-text text-center">
                    <i class="large material-icons block">speaker_notes</i>
                    <span class="card-title"><?php echo $enquirycount;?> Enquiries</span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col s12">
            <div class="row">
                <div class="col s12 drawchintantable">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col m6 l6">
                                <h5 class="panel-title">Latest Enquiries</h5>
                            </div>

                        </div>
                    </div>
                    <table class="highlight responsive-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Timestamp</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
    function drawtable(resultrow) {
        return "<tr><td>" + resultrow.id + "</td><td>" + resultrow.name + "</td><td>" + resultrow.email + "</td><td>" + resultrow.timestamp + "</td><td><a class='btn btn-primary btn-xs waves-effect waves-light blue darken-4 z-depth-0 less-pad' href='<?php echo site_url('site/editEnquiry?id=');?>" + resultrow.id + "'><i class='material-icons'>pageview</i></a></td></tr>";
    }
    generatejquery('<?php echo $base_url;?>');
    </script>
