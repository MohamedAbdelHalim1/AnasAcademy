<?php

namespace App\Policies;

use App\Models\User;


class ProductPolicy
{
    /*
    We will allow only user with id=1 which i seed and he was admin@admin.com
     */
    

     public function update_product(User $user){
        return $user->id == 1;    //which is admin i seed in database
     }

     public function delete_product(User $user){
        return $user->id == 1;    
     }


}
