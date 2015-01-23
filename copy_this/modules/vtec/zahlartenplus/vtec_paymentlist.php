<?php

class  vtec_paymentlist extends vtec_paymentlist_parent
{

/**
     * Creates payment list filter SQL to load current state payment list
     *
     * @param string $sShipSetId user chosen delivery set
     * @param double $dPrice     basket products price
     * @param oxuser $oUser      session user object
     *
     * @return string
     */
    protected function _getFilterSelect($sShipSetId, $dPrice, $oUser)
    {
        $oDb = oxDb::getDb();
        $sBoni = ($oUser && $oUser->oxuser__oxboni->value) ? $oUser->oxuser__oxboni->value : 0;
      

        $sTable = getViewName('oxpayments');
        $sQ = "select {$sTable}.* from ( select distinct {$sTable}.* from {$sTable} ";
        $sQ .= "left join oxobject2group ON oxobject2group.oxobjectid = {$sTable}.oxid ";
        $sQ .= "inner join oxobject2payment ON oxobject2payment.oxobjectid = " . $oDb->quote($sShipSetId) . " and oxobject2payment.oxpaymentid = {$sTable}.oxid ";
        $sQ .= "where {$sTable}.oxactive='1' ";
        
        $sQ .= " and (". $oDb->quote($sBoni)." >= {$sTable}.oxfromboni and ".$oDb->quote($sBoni)."<= {$sTable}.vtectoboni ) and {$sTable}.oxfromamount <= " . $oDb->quote($dPrice) . " and {$sTable}.oxtoamount >= " . $oDb->quote($dPrice);
                                                                                        
        // defining initial filter parameters
        $sGroupIds = '';
        $sCountryId = $this->getCountryId($oUser);

        // checking for current session user which gives additional restrictions for user itself, users group and country
        if ($oUser) {
            // user groups ( maybe would be better to fetch by function oxuser::getUserGroups() ? )
            foreach ($oUser->getUserGroups() as $oGroup) {
                if ($sGroupIds) {
                    $sGroupIds .= ', ';
                }
                $sGroupIds .= "'" . $oGroup->getId() . "'";
            }
        }

        $sGroupTable = getViewName('oxgroups');
        $sCountryTable = getViewName('oxcountry');

        $sCountrySql = $sCountryId ? "exists( select 1 from oxobject2payment as s1 where s1.oxpaymentid={$sTable}.OXID and s1.oxtype='oxcountry' and s1.OXOBJECTID=" . $oDb->quote($sCountryId) . " limit 1 )" : '0';
        $sGroupSql = $sGroupIds ? "exists( select 1 from oxobject2group as s3 where s3.OXOBJECTID={$sTable}.OXID and s3.OXGROUPSID in ( {$sGroupIds} ) limit 1 )" : '0';

        $sQ .= " ) as $sTable where (
            select
                if( exists( select 1 from oxobject2payment as ss1, $sCountryTable where $sCountryTable.oxid=ss1.oxobjectid and ss1.oxpaymentid={$sTable}.OXID and ss1.oxtype='oxcountry' limit 1 ),
                    {$sCountrySql},
                    1) &&
                if( exists( select 1 from oxobject2group as ss3, $sGroupTable where $sGroupTable.oxid=ss3.oxgroupsid and ss3.OXOBJECTID={$sTable}.OXID limit 1 ),
                    {$sGroupSql},
                    1)
                )  order by {$sTable}.oxsort asc ";

        return $sQ;
    }
}