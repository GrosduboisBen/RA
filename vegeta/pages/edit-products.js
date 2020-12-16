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
                <Card  title="Set up your dates"
                primaryFooterAction={{
                    content : ' Save',
                    onAction: () => redirectToHome()
            }}>
                    
                
                <FormOnSubmitExample>
                </FormOnSubmitExample>
                </Card>
            </Page>
        );
    }
}
export default EditProduct;