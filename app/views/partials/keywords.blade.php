             <div id="table_keywords">
                <h4 class="tbl-title">
                    <span class="glyphicon glyphicon-list-alt"></span>
                    LIST OF SEARCH KEYWORDS
                </h4>
                <div class="tbl-div">
                    <table class="table table-striped table-hover tbl-my-style" id="tbl-user-list">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Search Key Words</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($list_of_keywords as $words)
                            <tr >
                                <td>{{{ $words->id_keywords_temp }}}</td>
                                <td>{{{ $words->keywords }}}</td>                    
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $list_of_keywords->links() }}
            </div>  

     