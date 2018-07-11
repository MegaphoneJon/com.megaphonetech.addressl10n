{if $action eq 1 or $action eq 2 or $action eq 8}
   {include file="CRM/AddressFormat/Form/Address.tpl"}
{else}
    <div class="help">
      <p>{ts}CiviCRM lets you store multiple postal addFormatress formats, so you can set it to the preferred format of your country{/ts}</p>
    </div>

    <div class="action-link">
      {crmButton q="action=add&reset=1" id="newFAddressType"  icon="plus-circle"}{ts}Add Address Format{/ts}{/crmButton}
      {crmButton p="civicrm/admin" q="reset=1" class="cancel" icon="times"}{ts}Done{/ts}{/crmButton}
    </div>

  <div class="crm-content-block crm-block">
    {if $rows}
      <div id="ltype">
        <p></p>
        <div class="form-item">
          {strip}
            {include file="CRM/common/jsortable.tpl"}
            <table cellpadding="0" cellspacing="0" border="0" class="row-highlight">
              <thead class="sticky">
                <th>{ts}Country{/ts}</th>
                <th>{ts}Address Format{/ts}</th>
                <th></th>
              </thead>
              {foreach from=$rows item=row}
                <tr id="address_formats-{$row.id}" class="crm-entity {cycle values="odd-row,even-row"} {$row.class}">
                  <td>{$row.name}</td>
                  <td>{$row.format|nl2br}</td>
                  <td>{$row.action|replace:'xx':$row.id}</td>
                </tr>
              {/foreach}
            </table>
          {/strip}
        </div>
      </div>
    {else}
      <div class="messages status no-popup">
        <div class="icon inform-icon"></div>
        {ts}None found.{/ts}
      </div>
    {/if}
    {if $action ne 1 and $action ne 2}
      <div class="action-link">
        {crmButton q="action=add&reset=1" id="newFAddressType"  icon="plus-circle"}{ts}Add Address Format{/ts}{/crmButton}
        {crmButton p="civicrm/admin" q="reset=1" class="cancel" icon="times"}{ts}Done{/ts}{/crmButton}
      </div>
    {/if}
  </div>
{/if}
