import React, { Component } from 'react';
import PropTypes from "prop-types";
import { Textfield, Layout, Header, HeaderRow, Navigation, Drawer, Content } from 'react-mdl';

const NavigationBar = (props) => {
    return (
        <div>
            <div className="demo-big-content">
    <Layout>
        <Header waterfall>
            <HeaderRow title="Title">
                <Textfield
                    value="Search"
                    onChange={() => {}}
                    label="Search2"
                    expandable
                    expandableIcon="search"
                />
            </HeaderRow>
            <HeaderRow>
                <Navigation>
                    <a href="#">Find by id</a>
                </Navigation>
            </HeaderRow>
        </Header>
        <Drawer title="Title">
            <Navigation>
                <a href="#">Find by id</a>
            </Navigation>
        </Drawer>
        <Content>
            <div className="page-content" />
        </Content>
    </Layout>
</div>
</div>
    );
}



export default NavigationBar;