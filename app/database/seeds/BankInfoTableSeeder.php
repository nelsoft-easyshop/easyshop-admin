<?php

class BankInfoTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('es_bank_info')->delete();
       
        BankInfo::create([
            'id_bank' => '1', 
            'bank_name' => 'Al-Amanah Islamic Investment Bank of the Philippines', 
            'bank_short_name' => ''
        ]);
        
        BankInfo::create([
            'id_bank' => '2', 
            'bank_name' => 'Asia United Bank', 
            'bank_short_name' => ''
        ]);

        BankInfo::create([
            'id_bank' => '3',
            'bank_name' => 'Australia and New Zealand Banking Group', 
            'bank_short_name' => ''
        ]);

        BankInfo::create([
            'id_bank' => '4', 
            'bank_name' => 'Banco de Oro Universal Bank (BDO Unibank)', 
            'bank_short_name' => 'BDO'
        ]);

        BankInfo::create([
            'id_bank' => '5', 
            'bank_name' => 'Bangkok Bank', 
            'bank_short_name' => ''
        ]);

        BankInfo::create([
            'id_bank' => '6', 
            'bank_name' => 'Bank of America, N.A.', 
            'bank_short_name' => ''
        ]);

        BankInfo::create([
            'id_bank' => '7', 
            'bank_name' => 'Bank of China', 
            'bank_short_name' => ''
        ]);
        
        BankInfo::create([
            'id_bank' => '8', 
            'bank_name' => 'Bank of Commerce', 
            'bank_short_name' => 'BOC'
        ]);

        BankInfo::create([
            'id_bank' => '9',
            'bank_name' => 'Bank of the Philippine Islands (BPI)', 
            'bank_short_name' => 'BPI'
        ]);

        BankInfo::create([
            'id_bank' => '10', 
            'bank_name' => 'China Banking Corporation (Chinabank)', 
            'bank_short_name' => 'Chinabank'
        ]);

        BankInfo::create([
            'id_bank' => '11', 
            'bank_name' => 'Citibank, N.A.', 
            'bank_short_name' => ''
        ]);

        BankInfo::create([
            'id_bank' => '12', 
            'bank_name' => 'CTBC Bank', 
            'bank_short_name' => ''
        ]);

        BankInfo::create([
            'id_bank' => '13', 
            'bank_name' => 'Deutsche Bank AG', 
            'bank_short_name' => ''
        ]);

        BankInfo::create([
            'id_bank' => '14', 
            'bank_name' => 'Development Bank of the Philippines', 
            'bank_short_name' => 'DBP'
        ]);


        BankInfo::create([
            'id_bank' => '15', 
            'bank_name' => 'East West Bank', 
            'bank_short_name' => ''
        ]);
    
        BankInfo::create([
            'id_bank' => '16', 
            'bank_name' => 'Hongkong and Shanghai Banking Corporation', 
            'bank_short_name' => ''
        ]);
        
        BankInfo::create([
            'id_bank' => '17', 
            'bank_name' => 'ING Group', 
            'bank_short_name' => ''
        ]);
        
        BankInfo::create([
            'id_bank' => '18', 
            'bank_name' => 'JPMorgan Chase', 
            'bank_short_name' => ''
        ]);
        
        BankInfo::create([
            'id_bank' => '19', 
            'bank_name' => 'Korea Exchange Bank', 
            'bank_short_name' => ''
        ]);
        
        BankInfo::create([
            'id_bank' => '20', 
            'bank_name' => 'Land Bank of the Philippines', 
            'bank_short_name' => 'LBP'
        ]);
        
        BankInfo::create([
            'id_bank' => '21', 
            'bank_name' => 'Maybank', 
            'bank_short_name' => ''
        ]);

        BankInfo::create([
            'id_bank' => '22', 
            'bank_name' => 'Mega International Commercial Bank', 
            'bank_short_name' => ''
        ]);
        
        BankInfo::create([   
            'id_bank' => '23', 
            'bank_name' => 'Metropolitan Bank and Trust Company', 
            'bank_short_name' => 'Metrobank'
        ]);
        
        BankInfo::create([   
            'id_bank' => '24', 
            'bank_name' => 'Mizuho Corporate Bank', 
            'bank_short_name' => ''
        ]);
        
        BankInfo::create([   
            'id_bank' => '25', 
            'bank_name' => 'Philippine Bank of Communications', 
            'bank_short_name' => ''
        ]);

        BankInfo::create([   
            'id_bank' => '26', 
            'bank_name' => 'Philippine National Bank', 
            'bank_short_name' => 'PNB'
        ]);
        
        BankInfo::create([   
            'id_bank' => '27', 
            'bank_name' => 'Philippine Veterans Bank', 
            'bank_short_name' => ''
        ]);
        
        BankInfo::create([   
            'id_bank' => '28', 
            'bank_name' => 'Philtrust Bank (Philippine Trust Company)', 
            'bank_short_name' => 'PTC'
        ]);

        BankInfo::create([   
            'id_bank' => '29', 
            'bank_name' => 'Rizal Commercial Banking Corporation', 
            'bank_short_name' => 'RCBC'
        ]);
        
        BankInfo::create([   
            'id_bank' => '30', 
            'bank_name' => 'Robinsons Bank Corporation', 
            'bank_short_name' => ''
        ]);
        
        BankInfo::create([   
            'id_bank' => '31', 
            'bank_name' => 'Security Bank Corporation', 
            'bank_short_name' => ''
        ]);

        BankInfo::create([   
            'id_bank' => '32', 
            'bank_name' => 'Standard Chartered Bank', 
            'bank_short_name' => ''
        ]);

        
        BankInfo::create([   
            'id_bank' => '33', 
            'bank_name' => 'The Bank of Tokyo-Mitsubishi UFJ, Ltd.', 
            'bank_short_name' => ''
        ]);

        BankInfo::create([   
            'id_bank' => '34', 
            'bank_name' => 'UnionBank of the Philippines', 
            'bank_short_name' => 'Unionbank'
        ]);
        
        BankInfo::create([   
            'id_bank' => '35', 
            'bank_name' => 'United Coconut Planters Bank', 
            'bank_short_name' => 'UCPB'
        ]);

        BankInfo::create([   
            'id_bank' => '36', 
            'bank_name' => 'Philippine Saving Bank', 
            'bank_short_name' => 'PSBANK'
        ]);


    }

}
