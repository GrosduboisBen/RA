import React, { useCallback, useState } from "react";
import {
    Page,
    Card,
    Banner,
    Button,
    TextField,
    Form,
    FormLayout
} from "@shopify/polaris";
import { Redirect } from '@shopify/app-bridge/actions';
import { Context } from '@shopify/app-bridge-react';
import FormOnSubmitExample from '../components/WK-edit-products'

class EditProduct extends React.Component {
    static contextType = Context;
    state = { open: false };
    render() {
        const app = this.context;
        const redirectToHome = () => {
            const redirect = Redirect.create(app);
            redirect.dispatch(
                Redirect.Action.APP,
                '/',
            );
        };
        return (
            <Page>
                <Card>
                    <Banner  title="Order archived">
                    <Button onClick={redirectToHome}>Save</Button>
                    </Banner>
                </Card>
                <FormOnSubmitExample>
                </FormOnSubmitExample>
                
            </Page>
        );
    }
}
export default EditProduct;